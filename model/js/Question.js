class Question {

    id;
    content;
    themeid;
    answers;

    constructor(id,content,themeid,answers) {
        this._id = id;
        this._content = content;
        this._themeid = themeid;
        this._answers = answers;
    }


    get id() {
        return this._id;
    }

    get content() {
        return this._content;
    }

    get themeid() {
        return this._themeid;
    }

    get answers() {
        return this._answers;
    }
}