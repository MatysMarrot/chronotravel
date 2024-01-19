export class Student {

    id;
    login;


    constructor(parsedJson) {
        this.id = parsedJson.id;
        this.login = parsedJson.login;
    }


    get id() {
        return this.id;
    }

    get login() {
        return this.login;
    }

}