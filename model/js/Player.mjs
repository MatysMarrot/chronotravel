import "./Student.mjs";
import {Student} from "./Student.mjs";
export class Player {
    //Représente un joueur localement
    //Contient un objet student (id + login), une position

    student;
    position;
    id;
    login;

    /**
     * Crée un objet Player avec un élève et une position
     * @param studentJson = eleve depuis un json json parsé avec un id et un login
     * @param position = position sur le plateau
     */
    constructor(id,login, position = 0) {
        this.student = new Student(id,login);
        this.position = position;

        //Doublon mais j'ai trop peur de supprimer
        this.id = id;
        this.login = login;
    }

    get student() {
        return this.student;
    }

    get position() {
        return this.position;
    }

    move(nbrDeCases = 0){
        this.position = (nbrDeCases + this.position > 31) ? 31 :  this.position + nbrDeCases;
    }
}