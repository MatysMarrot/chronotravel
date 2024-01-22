document.addEventListener('DOMContentLoaded', function () {
    // Récupérer le bouton et le paragraphe contenant le texte "Dys"
    const fontToggleBtn = document.getElementById('fontToggleBtn');
    const dysText = document.getElementById('dysText');
    const body = document.body;

    // Ajouter un écouteur d'événements au clic sur le bouton
    fontToggleBtn.addEventListener('click', function () {
        // Vérifier si la classe est déjà présente sur le paragraphe
        if (dysText.classList.contains('dyslexic-font')) {
            // Si la classe est présente, la supprimer (revenir à la police par défaut)
            dysText.classList.remove('dyslexic-font');
            body.classList.remove('dyslexic-font');
        } else {
            // Si la classe n'est pas présente, l'ajouter (utiliser la police spéciale)
            dysText.classList.add('dyslexic-font');
            body.classList.add('dyslexic-font');
        }
    });
});
