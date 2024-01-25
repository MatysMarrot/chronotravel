const CELPERLINE = 10;
const LINES = 5;
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
        this.idTravel();
    }
    clear() {
        let i = 0;
        for (let cells of this.listeCellules) {
            cells.textContent = i;
            i++;
        }
    }

    idTravel(){
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