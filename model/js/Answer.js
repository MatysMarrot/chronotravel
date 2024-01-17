class Answer{

    id;
    questionid;
    content;
    correct;

    constructor(id,questionid,content,correct) {
        this._id = id;
        this._questionid = questionid;
        this._content = content;
        this._correct = correct;
    }


    get id() {
        return this._id;
    }

    get questionid() {
        return this._questionid;
    }

    get content() {
        return this._content;
    }

    get correct() {
        return this._correct;
    }
}