import "./Player.mjs";
import "./Board.mjs";
import {Board} from "./Board.mjs";
import {Tableau} from "./Tableau.mjs";
import {Player} from "./Player.mjs";
import {VictoryPacket} from "./packets/VictoryPacket.js";
import {MovementPacket} from "./packets/MovementPacket.mjs";
import {QuestionPacket} from "./packets/QuestionPacket.js";
import {AnswerPacket} from "./packets/AnswerPacket.mjs";
import {LeavePacket} from "./packets/LeavePacket.mjs";
import {retrieveSessionFromDiv} from "../../controler/utils/jsUtils.mjs";
import {QuizController} from "./Quiz.mjs";

export class Party{
    //Représente une partie de manière locale

    board;                  //objet plateau
    id;                     //Id de la partie
    currentClient;          //Session PHP restoré par une technique ninja occulte
    players;                //Map idJoueur -> Player object
    isOver = false;         //Boolean sur l'etat de vie de la partie
    inMiniJeux = false;     //Boolean sur l'etat actuel des mini-jeux
    socket;                 //Socket de connection avec le PHP
    quiz;                   //Objet quiz

    constructor(board, json, socket) {
        //Construit a partir d'un JoinPacket
        //Documentation technique dans packet.doc.md

        this.board = new Tableau(board);                //Nouveau tableau a partir du tableau HTML
        this.id = json.partyid;
        this.currentClient = retrieveSessionFromDiv().id;           //session PHP du client (pour des infos tels que l'id du client)

        //On crée une nouvelle map
        this.players = new Map();
        for (let joueurs of json.players){
            //On lit tout les joueurs dans le packet
            this.players.set(joueurs.id,new Player(joueurs.id,joueurs.login,0));
        }


        this.socket = socket;

        //On dessines le tableau avec les joueurs qu'on vient de recevoir
        this.drawPlayerPosition();

    }

    get id() {
        return this.id;
    }

    get owner() {
        return this.owner;
    }

    get players() {
        return this.players;
    }

    get board (){
        return this.board;
    }

    handlePacket(parsedData){
        //Fonction de traitement des packets:
        //Crée un objet packet en fonction de la propriété "action" du packet
        //Doc dispo dans packet.doc.md

        let packet = null;
        //On identifie le type de packet recu !
        switch (parsedData.action) {
            //ne doit jamais arriver
            case "create": return;
            case "victory":{
                //Packet de victoire
                packet = new VictoryPacket(this, parsedData);
            } break;

            case "movement":{
                //Packet de mouvement (faire avancer les joueurs)
                packet = new MovementPacket(this, parsedData);
            } break;

            case "question":{
                //Packet de question (les questions pour ce joueur)
                packet = new QuestionPacket(this,parsedData);
                //Hey, this is a test
            } break;
            case "leave":{
                //Packet de leave (un joueur a quitté la partie)
                packet = new LeavePacket(this,parsedData);
                packet.handle();
            }break;
        }

        //Si le packet a été formé correctement et que la partie peut traiter un packet
        if (!this.isOver && !this.inMiniJeux && packet != null){
            //On traite le packet (merci le polymorphisme)
            packet.handle(this);
        }
    }

    updatePlayerPosition(playersMovement){
        //Fonction appelé depuis le handle de MovementPacket
        //Modifie la position du joueur en fonction du packet de mouvement reçu
        for (let [playerId, movement] of playersMovement) {

            // On cherche le joueur associé
            let playerObject = this.players.get(playerId);

            // Si on ne le trouve pas, on passe au suivant
            if (playerObject == null) {
                continue;
            }

            //On le fait avancer
            playerObject.move(movement);
        }

        //On dessine les posistions de tout les joueurs
        this.drawPlayerPosition();
    }

    declareWinner(winners){
        //Fonction appelé depuis le handle de VictoryPacket

        //Si 0 gagnant (ne doit pas arriver);
        if (winners == null  || winners.length === 0){
            alert("It's too bad, but no one won...");
            return;
        }

        //On change l'état de la partie
        this.isOver = true;

        //On affiche un message différent selon le nombre de joueurs sur la dernière case du plateau
        switch (winners.length) {
            case 1: {
                // cas classique, 1 gagnant
                alert("Le gagnant est " + winners[0]);
            } break;

            default: {
                // plus de 1 gagnant :
                let msg = 'Les gagants sont ';
                //itération sur le nombre de gagant -1 pour ajouter des virgules
                for (let i = 0; i < winners.length-2; i++){
                    msg += winners[i] + ", ";
                }

                //On ajoute le point d'exclamation final
                msg += winners[winners.length -1] + " ! ";
                alert(msg);
            }
        }
        //redirection vers la page d'acceuil
        window.location.href = "../../controler/home.ctrl.php";
    }

    drawPlayerPosition() {
        //Vide la tableau (enlève les noms des joueurs)
        this.board.clear();

        //Redessine le nom de chaque joueur sur la case où il est
        this.players.forEach((value, key, map) => {
            this.board.listeCellules.at(value.position).textContent += " " + value.student.login + " ";
        });
    }

    startMinigame(questionPacket) {
        //Fonction appelé depuis le Handle de QuestionPacket
        //Documentation dans packet.doc.md

        //ne doit pas arriver mais rien n'est impossible dans la vie
        if (this.inMiniJeux){
            console.log("Tried to start a second minigame ?");
            return;
        }

        //On change l'état de la partie pour les MJ
        this.inMiniJeux = true;

        //Nouvel objet quiz
        this.quiz = new QuizController(this);

        //On affiche le quiz
        this.quiz.show();

        //On change l'affichage du thème en fonction du packet de question recu
        let theme = document.getElementById('theme');

        //nombre aléatoire pour choisir une image dans toutes les images disponibles pour un thème
        let nombreAleatoire = Math.floor(Math.random() * 8) + 1;
        //   console.log(questionPacket.data.questions[0].themeid);
        switch (parseInt(questionPacket.data.questions[0].themeid)){
            //Thème Antiquité
            case 1:
                //On change l'image de fond
                document.body.style.backgroundImage = "url('../view/img/theme/1-antiquite/"+ nombreAleatoire +"-img-antiquite.jpg')";
                //On change le "titre" du qcm
                theme.innerHTML = 'Antiquité';
                break;
            //Thème Moyen-age
            case 2:
                document.body.style.backgroundImage = "url('../view/img/theme/2-moyenage/1-img-moyenage.jpg')";
                theme.innerHTML = 'Moyen-Age';
                break;
            //Epoque moderne
            case 3:
                document.body.style.backgroundImage = "url('../view/img/theme/3-moderne/"+ nombreAleatoire +"-img-moderne.jpg')";
                theme.innerHTML = 'Epoque moderne';
                break;

            //Epoque contemporaine
            case 4:
                //console.log("IN");
                document.body.style.backgroundImage = "url('../view/img/theme/4-contemp/"+ nombreAleatoire +"-img-contemp.jpg')";
                theme.innerHTML = 'Epoque conptemporaine';
                break;

        }
        //début de la partie
        //On passe l'array de questions associé
        this.quiz.start(questionPacket.questions);

    }

    endMinigame(arrayofAnswers){
        //Fonction appelé depuis quiz.end()
        //Si aucun quiz n'est en cours on ne fait rien
        if(this.quiz == null) return;

        //On cache le quiz
        this.quiz.hide();

        //Fonc classique
        document.body.style.backgroundImage = "url('../view/assets/background.png')";

        //Changement d'état de la partie
        this.inMiniJeux = false;

        //On récupère les réponses passé en paramètre --> un array de booléen
        let answer = new AnswerPacket(this.currentClient, this.id, arrayofAnswers);

        // on gère le nouveau packet
        answer.handle(this.socket);

        //On vide l'instance
        this.quiz = null;
    };


}