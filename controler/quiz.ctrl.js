import AbstractMinijeu from "../model/js/AbstractMinijeu.mjs";

class QuizController extends AbstractMinijeu {
    constructor() {
        super();

        // récupère les labels et la question
        const labels = this.getLabels();
        const question = this.getQuestion();

        // affiche la question dans la console
        console.log(question);

        //affiche chaque réponse dans la console (boucle qui parcours tous les label)
        labels.forEach(function(label) {
            console.log(label.innerText);
        });

        document.addEventListener("DOMContentLoaded", function() {
            var answerCells = document.querySelectorAll(".answer");
            var selectedAnswerText = document.getElementById("selectedAnswerText");

            answerCells.forEach(function(cell) {
                cell.addEventListener("click", function() {
                    //réinitialise la couleur de fond de toutes les cellules à chaque nouveau click
                    answerCells.forEach(function(cell) {
                        cell.style.backgroundColor = "#0059FF";
                    });

                    //change la couleur de fond de la cellule cliquée (orange)
                    this.style.backgroundColor = "#FF8C00";

                    //obtient le texte de la réponse sélectionnée dans le label
                    var selectedAnswer = this.querySelector(".answer label").innerText;

                    // maj du texte affiché
                    selectedAnswerText.innerText = selectedAnswer;
                });
            });
        });
    }
}

// crée une instance du contrôleur
const quizController = new QuizController();
