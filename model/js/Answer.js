class Answer{

    id;
    questionid;
    content;
    correct;

    constructor(id,questionid,content,correct) {
        this.id = id;
        this.questionid = questionid;
        this.content = content;
        this.correct = correct;
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