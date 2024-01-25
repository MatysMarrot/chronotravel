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
    board;
    id;
    currentClient;
    players;
    isOver = false;
    inMiniJeux = false;
    socket;
    quiz;

    constructor(board, json, socket) {
        /**
         * FORME DU JSON:
         * {
         *     partyId: int
         *     currentClient: int
         *     players{
         *         student{
         *             id: int
         *             login: string
         *         }
         *     }
         *
         * }
         */

        //console.log(json);

        this.board = new Tableau(board);
        this.id = json.partyid;
        this.currentClient = retrieveSessionFromDiv().id;
        this.players = new Map();
        for (let joueurs of json.players){
            this.players.set(joueurs.id,new Player(joueurs.id,joueurs.login,0));
            //this.players.push();
        }


        this.socket = socket;

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
        let packet = null;
        //On identifie le type de packet recu !
        switch (parsedData.action) {
            //ne doit jamais arriver
            case "create": return;
            case "victory":{
                packet = new VictoryPacket(this, parsedData);
            } break;

            case "movement":{
                packet = new MovementPacket(this, parsedData);
            } break;

            case "question":{
                console.log("QUESTION PACKET ");
                packet = new QuestionPacket(this,parsedData);
                console.log("QUESTION PACKET : "+ packet);
                //Hey, this is a test
            } break;
            case "leave":{
                packet = new LeavePacket(this,parsedData);
            }break;
            case "victory":{
                console.log(parsedData);
                packet = new VictoryPacket(this,parsedData);
                console.log(packet);
            }

        }

        //TODO : verifier la classe
        if (!this.isOver && !this.inMiniJeux && packet != null){
            packet.handle(this);
        }
    }

    updatePlayerPosition(playersMovement){

        for (let [playerId, movement] of playersMovement) {

            // On cherche le joueur associé
            let playerObject = this.players.get(playerId);

            // Si on ne le trouve pas, on passe au suivant
            if (playerObject == null) {
                continue;
            }

            playerObject.move(movement);
        }

        this.drawPlayerPosition();
    }

    declareWinner(winners){
        //TODO : PROPER VICTORY SCREEN AND MESSAGE
        if (winners == null  || winners.length === 0){
            alert("It's too bad, but no one won...");
            return;
        }

        this.isOver = true;
        switch (winners.length) {
            case 1: {
                alert("Le gagnant est " + winners[0]);
            } break;

            default: {
                let msg = 'Les gagants sont ';
                for (let i = 0; i < winners.length-2; i++){
                    msg += winners[i] + ", ";
                }

                msg += winners[winners.length -1] + " ! ";
                alert(msg);
            }
        }
    }

    drawPlayerPosition() {
        this.board.clear();
        this.players.forEach((value, key, map) => {
            this.board.listeCellules.at(value.position).textContent += " " + value.student.login + " ";
        });
    }

    startMinigame(questionPacket) {
        if (this.inMiniJeux){
            console.log("Tried to start a second minigame ?");
            return;
        }

        this.inMiniJeux = true;
        this.quiz = new QuizController(this);
        this.quiz.show();
        let theme = document.getElementById('theme');
        let nombreAleatoire = Math.floor(Math.random() * 8) + 1;
        console.log(questionPacket.data.questions[0].themeid);
        switch (parseInt(questionPacket.data.questions[0].themeid)){
            case 1:
                document.body.style.backgroundImage = "url('../view/img/theme/1-antiquite/"+ nombreAleatoire +"-img-antiquite.jpg')";
                theme.innerHTML = 'Antiquité';
                break;
            case 2:
                document.body.style.backgroundImage = "url('../view/img/theme/2-moyenage/1-img-moyenage.jpg')";
                theme.innerHTML = 'Moyen-Age';
                break;
            case 3:
                document.body.style.backgroundImage = "url('../view/img/theme/3-moderne/"+ nombreAleatoire +"-img-moderne.jpg')";
                theme.innerHTML = 'Epoque moderne';
                break;
            case 4:
                console.log("IN");
                document.body.style.backgroundImage = "url('../view/img/theme/4-contemp/"+ nombreAleatoire +"-img-contemp.jpg')";
                theme.innerHTML = 'Epoque conptemporaine';
                break;

        }
        //document.body.style.background = 'red';
        this.quiz.start(questionPacket.questions);

    }

    endMinigame(arrayofAnswers){
        if(this.quiz == null) return;
        this.quiz.hide();
        document.body.style.backgroundImage = "url('../view/assets/background.png')";
        this.inMiniJeux = false;
        let answer = new AnswerPacket(this.currentClient, this.id, arrayofAnswers);
        console.log("sending :");
        console.log(answer);
        answer.handle(this.socket);
        this.quiz = null;
    };


}