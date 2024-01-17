class Student {

    id;
    firstname;
    lastname;
    login;
    email;

    constructor(id,login = '',firstname = '',lastname = '',email = '') {
        this.id = id;
        this.login = login;
        this.firstname = firstname;
        this.lastname = lastname;
        this.email = email;
    }


    get id() {
        return this.id;
    }

    get login() {
        return this.login;
    }

    get firstname() {
        return this.firstname;
    }

    get lastname() {
        return this.lastname;
    }

    get email() {
        return this.email;
    }
}