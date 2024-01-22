export class Question {

    id;
    content;
    themeid;
    answers;

    constructor(json) {
        this.id = json.id;
        this.content = json.content;
        this.themeid = json.themeid;
        this.answers = json.answers;
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