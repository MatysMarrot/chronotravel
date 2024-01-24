const divDys = document.querySelector('.dys').textContent;
const body = document.body;

// Vérifier si la classe est déjà présente sur le paragraphe
if (divDys === "1") {
    body.classList.add('dyslexic-font')
} else {
    body.classList.remove('dyslexic-font')
}
