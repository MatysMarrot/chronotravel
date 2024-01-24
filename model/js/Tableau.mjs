const CELPERLINE = 7;
const LINES = 8;
const CELL_SIZE = 10;

export class Tableau {
    table;
    listeCellules = [];

    visible;

    constructor(table, visible = true) {
        if (!table instanceof HTMLElement) {
            throw new Error("table should be HTMLElement not " + table.className);
        }

        this.table = table;
        this.listeCellules = [];
        this.visible = visible;
        this.initTable();
    }

    showtables() {
        if (!this.visible) {
            this.table.style.display = "block";
            this.visible = true;
        }
    }

    hidetables() {
        if (this.visible) {
            this.table.style.display = "none";
            this.visible = false;
        }
    }

    //TODO :
    /*window.addEventListener('resize', function () {
        if (document.getElementById("mytables").style.display === "block") {
            resizetables();
            drawtables();
        });
    }*/

    initTable() {
        let starCells = [];
        for (let i = 0; i < LINES; i++) {
            let row = this.table.insertRow(i);

            // Ajouter des cellules à chaque ligne
            for (let j = 0; j < CELPERLINE; j++) {
                let cell = row.insertCell(j);
                starCells.push(cell);
            }
        }

        let id = 0;
        for (let ligne = 0; ligne < this.table.rows.length; ligne++) {
            let row = this.table.rows[ligne];
            if (ligne % 4 === 2) {
                for (let coll = row.cells.length - 1; coll >= 0; coll--) {
                    row.cells[coll].classList.add('board_available');
                    row.cells[coll].id = id;
                    id++;
                    this.listeCellules.push(row.cells[coll]);
                }
            } else if (ligne % 2 === 0 && ligne % 4 !== 2) {
                for (let coll = 0; coll < row.cells.length; coll++) {
                    row.cells[coll].classList.add('board_available');
                    row.cells[coll].id = id;
                    id++;
                    this.listeCellules.push(row.cells[coll]);
                }
            } else if (ligne % 4 === 3) {
                row.cells[0].classList.add('board_available');
                row.cells[0].id = id;
                id++;
                this.listeCellules.push(row.cells[0]);
            } else if (ligne % 2 === 1 && ligne % 4 !== 3) {
                row.cells[row.cells.length - 1].classList.add('board_available');
                row.cells[row.cells.length - 1].id = id;
                id++;
                this.listeCellules.push(row.cells[row.cells.length - 1]);
            }
        }
        /*
        // Ajoute la classe "board_avalaible" aux cellules d'une ligne sur 2
                for (let ligne = 0; ligne < this.table.rows.length; ligne += 2) {
                    let row = this.table.rows[ligne];

                    for (let coll = 0; coll < row.cells.length; coll++) {
                        row.cells[coll].classList.add('board_available');
                    }
                }

        // Ajoute les cellules "descendantes" du chemin
                let dg = false;
                let position = 0;
                for (let i = 1; i < this.table.rows.length; i += 2) {
                    let row = this.table.rows[i];

                    (dg ? position = 0 : position = row.cells.length - 1);
                    let cellule = row.cells[position];

                    cellule.classList.add('board_available');
                    dg = !dg;
                }

        // Attribue des identifiants uniques à chaque cellule
                let id = 0;
                for (const cellules of starCells) {
                    if (!cellules.classList.contains("board_available")) {
                        continue;
                    }

                    cellules.id = id;
                    cellules.textContent = id;
                    id++;
                    this.listeCellules.push(cellules);
                }
            }
        */
    }
    clear() {
        let i = 0;
        for (let cells of this.listeCellules) {
            cells.textContent = i;
            i++;
        }
    }
}