export class Answer{
    //Représentation d'une réponse en JS

    id;                 //Id de la réponse en BDD
    questionid;         //Id de la question
    content;            //Texte de la réponse
    correct;            //Boolean pour si la réponse est correcte ou pas

    constructor(data) {
        this.id = data.id;
        this.questionid = data.questionId;
        this.content = data.content;
        this.correct = data.right;
    }


    get id() {
        return this.id;
    }

    get questionid() {
        return this.questionid;
    }

    get content() {
        return this.content;
    }

    get correct() {
        return this.correct;
    }
}