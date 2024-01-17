class Question {

    id;
    content;
    themeid;
    answers;

    constructor(id,content,themeid,answers) {
        this.id = id;
        this.content = content;
        this.themeid = themeid;
        this.answers = answers;
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