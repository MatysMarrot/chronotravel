import AbstractMinijeu from "../model/js/AbstractMinijeu.mjs";

class QuizController extends AbstractMinijeu {
    constructor() {
        super();

        // récupère les labels et la question
        const labels = document.querySelectorAll(".answer label");
        const question = document.querySelector("#question h3").innerText;

        // affiche la question dans la console
        console.log(question);

        //affiche chaque réponse dans la console (boucle qui parcours tous les label)
        labels.forEach(function(label) {
            console.log(label.innerText);
        });









        document.addEventListener("DOMContentLoaded", function() {
            // Récupère les labels et la question
            const labels = document.querySelectorAll(".answer label");
            const question = document.querySelector("#question h3").innerText;

            // Affiche la question dans la console
            console.log(question);

            // Affiche chaque réponse dans la console (boucle qui parcourt tous les labels)
            labels.forEach(function(label) {
                console.log(label.innerText);
            });






            // Ajoute le bouton et le gestionnaire d'événements
            var revealButton = document.getElementById("revealButton");

            revealButton.addEventListener("click", function() {
                // Révèle tous les éléments cachés en modifiant leur style.display
                var hiddenElements = document.querySelectorAll("#question, #answerTable, #selectedAnswerDisplay");
                hiddenElements.forEach(function(element) {
                    element.style.display = "block";
                });

                // Cache le bouton après avoir révélé les éléments
                revealButton.style.display = "none";
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
        });

    }
}

// crée une instance du contrôleur
const quizController = new QuizController();
