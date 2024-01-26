import AbstractMinijeu from "./AbstractMinijeu.mjs";
import "./Question.mjs";
import {Question} from "./Question.mjs";

export class QuizController extends AbstractMinijeu {
    //Objet Quiz
    //Contient la logique permettant de géré ce mini jeu


    alive = false;          //Etat du mini jeu (fini ou non)
    party;                  //objet party (composition)
    qcmContainer;           //div html du quiz
    jeuContainer;           //div html du boar
    functionTimer = () => this.endIfOutOfTime(); //Callback function pour eviter le stalling


    //Peut etre remplacé par une classe bouton
    buttons;                    //NodeList du td des boutons
    buttonsLabels;              //Labels des radioButtons
    questionLabel;              //Label de la question (ex: Le traité de verdun...)
    radioButtons;               //NodeList des boutons

    questionActuelle = 0;       //Numéro de la question que l'on traite

    mapReponsesbutton = new Map();      //Map des labels de l'objet réponse associé

    questions = [];                    //Questions reçus par le question packet
    answers = [];                      //Reponses filles de l'objet Question
    constructor(party) {
        super();
        this.party = party;

        // récupère les labels et la question
        this.questionLabel = document.querySelector("#question h3");
        this.buttonsLabels = document.querySelectorAll(".answer label");
        this.buttons = document.querySelectorAll(".answer");

        this.qcmContainer = document.getElementById("qcm");
        this.jeuContainer = document.getElementById("jeu")
        this.radioButtons = document.querySelectorAll('input[type="radio"]');

        this.radioButtons.forEach(btn => btn.addEventListener('click',() => this.changeColor(btn)));


    }

    endIfOutOfTime(){
        //Fonction qui stop ce qcm (pour éviter le stalling)

        //Si le qcm n'est pas fini
        if(!this.alive){
            return;
        }
        //On comble les réponses avec des "false"
        while(this.answers.length < this.questions.length){
            this.answers.push(false);
        }

        //On fini la partie
        this.end();
    }

    show(){
        // revèle le qcm
        this.qcmContainer.style.display = "block";
        this.jeuContainer.style.display = "none";
    }

    hide(){
        //Cache le qcm
        this.qcmContainer.style.display = "none";
        this.jeuContainer.style.display = "block";

        // décoche le radio button qui est coché
        this.radioButtons.forEach(function(radioButton) {

            //Si le bouton est coché
            if (radioButton.checked === true) {
                // TODO: à faire dans la classe Question.mjs pour la méthode isRightAnswer selectedAnswersArray.push(Question.isRightAnswer(selectedAnswerText));
                var cell = radioButton.closest('.answer');
                //On remet la bonne couleur de fond
                cell.style.backgroundColor = "#0059FF";

                // On décoche le bouton
                radioButton.checked = false;
                //On pourrait faire un return ici
            }
        });
    }


    start(arrayDeQuestions){
        //Fonction qui commence le MJ

        this.alive = true;
        //console.log(arrayDeQuestions);
        //on set les questions
        this.questions = arrayDeQuestions;
        this.questionActuelle = 0;
        this.setQuestion();

        //On affiche le qcm
        this.show();

        //On delay l'activation d'une fonction qui arrete si le joueur ne répond pas aux questions
        setTimeout(this.functionTimer,30000);
    }

    setQuestion(){
        //Fonction qui met a jour les questions

        //Si y'a pas de question
        if (this.questionActuelle >= this.questions.length){
            return;
        }
        let question = this.questions.at(this.questionActuelle);

        //Affiche le texte de la question
        this.questionLabel.innerText = question.content;

        //i -> Indication du nombre de réponses
        let i = 0;
        for (const btn of this.radioButtons){
            //Si on a pas parcouru toutes les réponses
            if (i >= question.answers.length){
                //On cache les bouton inutile
                this.buttons.item(i).style.display = "none";
                i++;
                continue;
            }

            //si il reste des réponses à afficher
            //On réactive le bouton associé
            btn.disabled = false;
            //On l'associe a sa réponse
            this.mapReponsesbutton.set(btn, question.answers.at(i));
            //On affiche le texte
            this.buttonsLabels.item(i).innerText = question.answers.at(i).content;

            //On affiche le bouton
            this.buttons.item(i).style.display = "";
            i++;

            //S'il y a plus de 4 réponses (ne doit pas arriver mais on est jamais trop prudent
            //On break pour éviter l'OOB
            if (i >= 4){break;}
        }

    }

    changeColor(button){
        //Change la couleur du bouton en fonction de la réponse séléctionné (vrai ou faux)

        //Si la réponse est bonne
        let isRightAnswer = Boolean(this.mapReponsesbutton.get(button).correct);

        //td associé
        let cell = button.parentNode;
        //Couleur du fond
        cell.style.backgroundColor = isRightAnswer ? 'green' : 'red' ;

        //On désactive tout les radio buttons pour éviter le double réponse
        this.radioButtons.forEach(function(radioButton) {

                radioButton.disabled = true;

        });

        //On delay la question suivante pour voir l'animation
        setTimeout(() => this.next(button),500);
    }

    next(button){
        //Function apellé quand on clique sur un bouton

        //Bonne ou mauvaise réponse
        let isRightAnswer = Boolean(this.mapReponsesbutton.get(button).correct);

        //td associé
        let cell = button.parentNode;

        //On remet la couleur de base
        cell.style.backgroundColor = "#0059FF" ;

        //On ajoute la réponse de l'utilisateur (vrai ou faux)
        this.answers.push(isRightAnswer);

        //On indique que l'on passe a la question suivante
        this.questionActuelle++;

        //Pour chaque bouton
        this.radioButtons.forEach(function(radioButton) {
            //On réactive les boutons, fait doublon
                cell = radioButton.closest('.answer');
                radioButton.disabled = false;
        });

        //Si on est a la dernière question
        if (this.questionActuelle === this.questions.length){
            //On arrete le timer anti Stalling
            clearTimeout(this.functionTimer);

            //On lance la fin du MJ
            this.end();
            return;
        }

        //Sinon, on passe a la question suivante
        this.setQuestion(this.questionActuelle);
    }

    end(){
        //On cache le MJ
        this.hide();

        // on le décris comme mort
        this.alive = false;

        //Fin du MJ, on passe les questions a la partie
        this.party.endMinigame(this.answers);
    }
}
