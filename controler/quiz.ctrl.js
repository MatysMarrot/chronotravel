import AbstractMinijeu from "../model/js/AbstractMinijeu.mjs";
import "../model/js/Question.mjs";
import {Question} from "../model/js/Question.mjs";

class QuizController extends AbstractMinijeu {
    constructor() {
        super();

        document.addEventListener("DOMContentLoaded", function() {
            // récupère les labels et la question
            const labels = document.querySelectorAll(".answer label");
            const question = document.querySelector("#question h3").innerText;

            // affiche la question dans la console
            console.log(question);

            //affiche chaque réponse dans la console (boucle qui parcours tous les label)
            labels.forEach(function(label) {
                console.log(label.innerText);
            });



            var answerCells = document.querySelectorAll(".answer");
            var selectedAnswerText = document.getElementById("selectedAnswerText");

            answerCells.forEach(function(cell) {
                cell.addEventListener("click", function() {
                    // Réinitialise la couleur de fond de toutes les cellules à chaque nouveau clic
                    answerCells.forEach(function(cell) {
                        cell.style.backgroundColor = "#0059FF";
                    });

                    // Change la couleur de fond de la cellule cliquée (orange)
                    this.style.backgroundColor = "#FF8C00";

                    // Obtient le texte de la réponse sélectionnée dans le label
                    var selectedAnswer = this.querySelector(".answer label").innerText;

                    // Met à jour le texte affiché
                    selectedAnswerText.innerText = selectedAnswer;
                });
            });



            var revealButton = document.getElementById("revealButton");
            var hideButton = document.getElementById("hideButton");
            var qcmContainer = document.getElementById("qcm");
            var radioButtons = document.querySelectorAll('input[type="radio"]');
            var selectedAnswersArray = [];

            revealButton.addEventListener("click", function() {
                // revèle le qcm
                qcmContainer.style.display = "block";
                revealButton.style.display = "none";
            });

            hideButton.addEventListener("click", function() {
                // cache le qcm
                qcmContainer.style.display = "none";
                revealButton.style.display = "block";

                // décoche le bouton radio qui est coché
                radioButtons.forEach(function(radioButton) {
                    if (radioButton.checked === true) {
                        //console.log(radioButton);
                        // TODO: à faire dans la classe Question.mjs pour la méthode isRightAnswer selectedAnswersArray.push(Question.isRightAnswer(selectedAnswerText));
                        var cell = radioButton.closest('.answer'); // .closest c'est le plus proche père qui est de classe .answer
                        cell.style.backgroundColor = "#0059FF";
                        radioButton.checked = false;
                    }
                });
                // réinitialise le texte de la réponse sélectionnée
                selectedAnswerText.innerText = "";
            });
        });
    }
}

// crée une instance du contrôleur
const quizController = new QuizController();
