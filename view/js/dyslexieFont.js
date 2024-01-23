const divDys = document.querySelector('.dys').textContent;
const body = document.body;
var button = document.querySelectorAll('button');

// Vérifier si la classe est déjà présente sur le paragraphe
if (divDys === "1") {
    body.classList.add('dyslexic-font')
    button.classList.add('dyslexic-font');
} else {
    body.classList.remove('dyslexic-font')
    button.classList.remove('dyslexic-font');
}