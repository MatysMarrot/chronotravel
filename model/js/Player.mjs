import "./Student.js";
import {Student} from "./Student.js";
export class Player {
    student;
    position;

    /**
     * Crée un objet Player avec un élève et une position
     * @param studentJson = eleve depuis un json json parsé avec un id et un login
     * @param position = position sur le plateau
     */
    constructor(studentJson, position = 0) {
        this.student = new Student(studentJson);
        this.position = position;
    }

    get student() {
        return this.student;
    }

    get position() {
        return this.position;
    }
}