document.addEventListener('DOMContentLoaded', function () {
    const fontToggleBtn = document.getElementById('fontToggleBtn');
    const body = document.body;

    // Ajouter un écouteur d'événements au clic sur le bouton
    fontToggleBtn.addEventListener('click', function () {
        // Vérifier si la classe est déjà présente sur le paragraphe
        if (fontToggleBtn.classList.contains('dyslexic-font')) {
            // Si la classe est présente, la supprimer (revenir à la police par défaut)
            fontToggleBtn.classList.remove('dyslexic-font')
            body.classList.remove('dyslexic-font');
        } else {
            // Si la classe n'est pas présente, l'ajouter (utiliser la police spéciale)
            fontToggleBtn.classList.add('dyslexic-font')
            body.classList.add('dyslexic-font');
        }
    });
});
