import {Answer} from "./Answer.mjs";
export class Question {
    //Représentation d'une question en JS

    id;                 //Id de la question
    content;            //texte
    themeid;            //Thème
    answers = [];       //Liste de réponses
    type = 1;           //Type en prédiction de questions a images

    constructor(data) {
        this.type = data.type;
        this.id = data.id;
        this.themeid = data.themeid;
        this.content = data.content;

        //Pour chaque champ réponse dans le packet
        for (let r of data.reponses){
            //On délégue la création et on stock
            this.answers.push(new Answer(r));
        }
    }


    get id() {
        return this.id;
    }

    get content() {
        return this.content;
    }

    get themeid() {
        return this.themeid;
    }

    get answers() {
        return this.answers;
    }

    getRightAnswer(){
        //TODO ;
    }

    isRightAnswer(reponse){
        //TODO :
    }
}