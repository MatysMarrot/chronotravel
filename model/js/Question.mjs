import {Answer} from "./Answer.mjs";
export class Question {

    id;
    content;
    themeid;
    answers = [];
    type = 1;

    constructor(data) {
        this.type = data.type;
        this.id = data.id;
        this.themeid = data.themeid;
        this.content = data.content;
        for (let r of data.reponses){
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
}