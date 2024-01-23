import AbstractMinijeu from "./AbstractMinijeu.mjs";
import "./Question.mjs";
import {Question} from "./Question.mjs";

export class QuizController extends AbstractMinijeu {
    qcmContainer;
    jeuContainer;


    buttons;
    buttonsLabels;
    questionLabel;
    radioButtons;

    questionActuelle = 0;

    mapReponsesbutton = new Map();

    questions = [];
    answers = [];
    constructor() {
        super();

        // récupère les labels et la question
        this.questionLabel = document.querySelector("#question h3");
        this.buttonsLabels = document.querySelectorAll(".answer label");
        this.buttons = document.querySelectorAll(".answer");

        this.qcmContainer = document.getElementById("qcm");
        this.jeuContainer = document.getElementById("jeu")
        this.radioButtons = document.querySelectorAll('input[type="radio"]');

        this.radioButtons.forEach(btn => btn.addEventListener('click',() => this.next(btn)));


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
                //console.log(radioButton);
                // TODO: à faire dans la classe Question.mjs pour la méthode isRightAnswer selectedAnswersArray.push(Question.isRightAnswer(selectedAnswerText));
                var cell = radioButton.closest('.answer'); // .closest c'est le plus proche père qui est de classe .answer
                cell.style.backgroundColor = "#0059FF";
                radioButton.checked = false;
            }
        });
    }


    start(arrayDeQuestions){
        //on set les questions
        this.questions = arrayDeQuestions;
        this.questionActuelle = 0;
        this.setQuestion();
        this.show();
    }

    setQuestion(){
        let question = this.questions.at(this.questionActuelle);
        //On vérifie le type

        this.questionLabel.innerText = question.content;
        console.log(this.radioButtons);

        let i = 0;
        for (const btn of this.radioButtons){
            console.log(btn);
            if (i >= question.answers.length){
                btn.display = "none";
                console.log("Button " + i + "is now hidden");
                continue;
            }

            this.mapReponsesbutton.set(btn, question.answers.at(i));
            btn.display = "block";
            i++;
        }

    }

    //Function apellé quand on clique sur un bouton
    next(button){
        let isRightAnswer = Boolean(this.mapReponsesbutton.get(button).correct);

        this.answers.push(isRightAnswer);
        console.log(this.questions.at(this.questionActuelle)+ " -> " + isRightAnswer);
        this.questionActuelle++;

        if (this.questionActuelle === this.questions.length){
            console.log("Reached the end !");
            this.hide();
            return;
        }

        this.setQuestion(this.questionActuelle);
    }
}
