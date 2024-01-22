class Answer{

    id;
    questionid;
    content;
    correct;

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