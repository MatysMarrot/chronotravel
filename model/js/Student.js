class Student {

    id;
    login;


    constructor(json) {
        this.id = json.id;
        this.login = json.login;
    }


    get id() {
        return this.id;
    }

    get login() {
        return this.login;
    }

}