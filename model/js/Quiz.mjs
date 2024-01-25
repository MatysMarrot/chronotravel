import AbstractMinijeu from "./AbstractMinijeu.mjs";
import "./Question.mjs";
import {Question} from "./Question.mjs";

export class QuizController extends AbstractMinijeu {

    alive = false;
    party;
    qcmContainer;
    jeuContainer;
    functionTimer = () => this.endIfOutOfTime();

    buttons;
    buttonsLabels;
    questionLabel;
    radioButtons;

    questionActuelle = 0;

    mapReponsesbutton = new Map();

    questions = [];
    answers = [];
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
        if(!this.alive){
            return;
        }
        while(this.answers.length < this.questions.length){
            this.answers.push(false);
        }
        this.end();
    }

    show(){
        // revèle le qcm
        this.qcmContainer.style.display = "block";
        this.jeuContainer.style.display = "none";
    }

    hide(){
        this.qcmContainer.style.display = "none";
        this.jeuContainer.style.display = "block";

        // décoche le bouton radio qui est coché
        this.radioButtons.forEach(function(radioButton) {
            if (radioButton.checked === true) {
                // TODO: à faire dans la classe Question.mjs pour la méthode isRightAnswer selectedAnswersArray.push(Question.isRightAnswer(selectedAnswerText));
                var cell = radioButton.closest('.answer'); // .closest c'est le plus proche père qui est de classe .answer
                cell.style.backgroundColor = "#0059FF";
                radioButton.checked = false;
            }
        });
    }


    start(arrayDeQuestions){
        this.alive = true;
        //console.log(arrayDeQuestions);
        //on set les questions
        this.questions = arrayDeQuestions;
        this.questionActuelle = 0;
        this.setQuestion();
        this.show();

        setTimeout(this.functionTimer,30000);
    }

    setQuestion(){
        //Si y'a pas de question
        if (this.questionActuelle >= this.questions.length){
            return;
        }
        let question = this.questions.at(this.questionActuelle);

        this.questionLabel.innerText = question.content;

        let i = 0;
        for (const btn of this.radioButtons){
            if (i >= question.answers.length){
                //console.log("hid button " + i);
                this.buttons.item(i).style.display = "none";
                i++;
                continue;
            }

            this.mapReponsesbutton.set(btn, question.answers.at(i));
            this.buttonsLabels.item(i).innerText = question.answers.at(i).content;
            this.buttons.item(i).style.display = "";
            i++;
            if (i >= 4){break;}
        }

    }

    changeColor(button){
        let isRightAnswer = Boolean(this.mapReponsesbutton.get(button).correct);
        let cell = button.parentNode; // .closest c'est le plus proche père qui est de classe .answer
        cell.style.backgroundColor = isRightAnswer ? 'green' : 'red' ;
        this.radioButtons.forEach(function(radioButton) {
            if (radioButton.checked === true) {
                let cell = radioButton.closest('.answer');
                radioButton.disabled = true;
            }
        });
        setTimeout(() => this.next(button),500);
    }

    //Function apellé quand on clique sur un bouton
    next(button){
        let isRightAnswer = Boolean(this.mapReponsesbutton.get(button).correct);
        let cell = button.parentNode; // .closest c'est le plus proche père qui est de classe .answer
        cell.style.backgroundColor = "#0059FF" ;
        this.answers.push(isRightAnswer);
        this.questionActuelle++;

        this.radioButtons.forEach(function(radioButton) {
            if (radioButton.checked === true) {
                cell = radioButton.closest('.answer');
                radioButton.disabled = false;
            }
        });

        //Si on est a la dernière question
        if (this.questionActuelle === this.questions.length){
            clearTimeout(this.functionTimer);
            this.end();
            return;
        }

        this.setQuestion(this.questionActuelle);
    }

    end(){
        this.hide();
        this.alive = false;
        this.party.endMinigame(this.answers);
    }
}
