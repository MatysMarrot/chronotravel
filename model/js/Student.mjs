export class Student {
    //Représente un student en JS

    id;
    login;


    constructor(id,login) {
        this.id = id;
        this.login = login;
    }


    get id() {
        return this.id;
    }

    get login() {
        return this.login;
    }

}