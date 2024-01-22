// Récupérer le bouton et le paragraphe contenant le texte "Dys"
const fontToggleBtn = document.getElementById('fontToggleBtn');
const dysText = document.getElementById('dysText');
const mode = document.querySelector('.mode');

// Ajouter un écouteur d'événements au clic sur le bouton
fontToggleBtn.addEventListener('click', function () {
    // Vérifier si la classe est déjà présente sur le paragraphe
    if (dysText.classList.contains('dyslexic-font')) {
        // Si la classe est présente, la supprimer (revenir à la police par défaut)
        dysText.classList.remove('dyslexic-font');
        // Supprimer la classe de la police spéciale du header
        mode.classList.remove('dyslexic-font');
    } else {
        // Si la classe n'est pas présente, l'ajouter (utiliser la police spéciale)
        dysText.classList.add('dyslexic-font');
        // Ajouter la classe de la police spéciale au header
        mode.classList.add('dyslexic-font');
    }
});
