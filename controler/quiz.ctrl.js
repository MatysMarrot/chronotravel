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