class Answer{

    id;
    questionid;
    content;
    correct;

    constructor(json) {
        this.id = json.id;
        this.questionid = json.questionid;
        this.content = json.content;
        this.correct = json.correct;
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