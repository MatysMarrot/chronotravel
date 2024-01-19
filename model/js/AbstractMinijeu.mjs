class AbstractMinijeu {
    constructor() {
    }

    // récupérer les labels
    getLabels() {
        return document.querySelectorAll(".answer label");
    }

    // récupérer la question dans la balise h3
    getQuestion() {
        return document.querySelector("#question h3").innerText;
    }
}

export default AbstractMinijeu;
