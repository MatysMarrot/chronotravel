const CELPERLINE = 10;
const LINES = 5;
const CELL_SIZE = 10;

export class Tableau {
    //Classe représentant le plateau

    table;                          //Element HTML racine
    listeCellules = [];             //Cellules avec id

    visible;                        //Booleen sur l'etat du plateau

    constructor(table, visible = true) {
        //Si l'élément racine n'est pas un HTML element on jete une exception
        if (!table instanceof HTMLElement) {
            throw new Error("table should be HTMLElement not " + table.className);
        }

        //On initialise
        this.table = table;
        this.listeCellules = [];
        this.visible = visible;
        this.initTable();
    }

    showtables() {
        //Montre le plateau
        if (!this.visible) {
            this.table.style.display = "block";
            this.visible = true;
        }
    }

    hidetables() {
        //Cache le tableau
        if (this.visible) {
            this.table.style.display = "none";
            this.visible = false;
        }
    }

    initTable() {
        //Initialise le plateau avec des cellules


        let starCells = [];         //Toutes les cellules, memes celles sans ID

        //pour chaque ligne
        for (let i = 0; i < LINES; i++) {
            let row = this.table.insertRow(i);

            //Pour chaque colonne
            //On ajoute des cellules
            for (let j = 0; j < CELPERLINE; j++) {
                let cell = row.insertCell(j);

                //on la garde de coté pour plus tard
                starCells.push(cell);
            }
        }

        //id -> id des cellules faisant partie du plateau
        let id = 0;

        //Pour chaque ligne
        for (let ligne = 0; ligne < this.table.rows.length; ligne++) {
            let row = this.table.rows[ligne];

            //Si la ligne va de droite à gauche (ligne 2 et 6)
            if (ligne % 4 === 2) {
                for (let coll = row.cells.length - 1; coll >= 0; coll--) {
                    //Pour chaque colonne

                    //On met le bon style a la celllule
                    row.cells[coll].classList.add('board_available');
                    //On met le bon id
                    row.cells[coll].id = id;
                    id++;

                    //On l'ajoute aux cellules de l'objet
                    this.listeCellules.push(row.cells[coll]);
                }
            } else if (ligne % 2 === 0 && ligne % 4 !== 2) {
                //si la ligne est
                for (let coll = 0; coll < row.cells.length; coll++) {
                    row.cells[coll].classList.add('board_available');
                    row.cells[coll].id = id;
                    id++;
                    this.listeCellules.push(row.cells[coll]);
                }
            } else if (ligne % 4 === 3) {
                //si la ligne est 3 ou 7 (uniquement une cellule)
                row.cells[0].classList.add('board_available');
                row.cells[0].id = id;
                id++;
                this.listeCellules.push(row.cells[0]);
            } else if (ligne % 2 === 1 && ligne % 4 !== 3) {
                //si la ligne est 1 ou 5 (une seule cellule)
                row.cells[row.cells.length - 1].classList.add('board_available');
                row.cells[row.cells.length - 1].id = id;
                id++;
                this.listeCellules.push(row.cells[row.cells.length - 1]);
            }
        }
        this.idTravel();
    }
    clear() {
        //vide les cellules des noms des joueurs
        //id de la case
        let i = 0;
        for (let cells of this.listeCellules) {
            //Pour chaque cellules de l'objet, on affiche son id
            cells.textContent = i;
            i++;
        }
    }

    idTravel(){
        //Fonction qui met une couleur en fonction de la position dans la liste (division par époque)
        var couleur;
        for (let cells of this.listeCellules) {
            var i = cells.id;
            if (i < 8) {
                couleur = '#FB8B24';
            } else if (i >= 8 && i < 16) {
                couleur = '#E36414';
            } else if (i >= 16 && i < 24) {
                couleur = '#9A031E';
            } else {
                couleur = '#5F0F40';
            }
            cells.style.backgroundColor = couleur;
        }
    }
}