const CELPERLINE = 10;
const LINES = 5;
const CELL_SIZE = 10;

export class Board {
    //DEPRECATED
    //Classe représentant le tableau HTML du plateau

    canva;              //Canva
    constructor(canva) {
        if (!canva instanceof HTMLElement){
            throw new Error("canva should be HTMLElement not " + canva.className);
        }

        this.canva = canva;
    }

    //Affiche le plateau
    showCanvas() {
        this.canva.style.display = "block";
        this.resizeCanvas();
        this.drawCanvas();
    }

    //Montre le plateau
    hideCanvas() {
        this.canva.style.display = "none";
    }

    //met le tableau a la bonne taille
    resizeCanvas() {
        this.canva.width = window.innerWidth;
        this.canva.height = window.innerHeight;
    }

    //Dessine des cases
    drawCell(ctx, x, y, isAvailable) {
        ctx.beginPath();
        ctx.rect(x * CELL_SIZE, y * CELL_SIZE, CELL_SIZE, CELL_SIZE);
        ctx.fillStyle = isAvailable ? "green" : "white";
        ctx.fill();
        ctx.stroke();
    }

    //Dessine le plateau
    drawCanvas() {
        const ctx = this.canva.getContext("2d");

        const CELLS_PER_LINE = 10;
        const LINES = 5;
        const CELL_SIZE = this.canva.width / CELLS_PER_LINE;

        for (let i = 0; i < LINES; i++) {
            for (let j = 0; j < CELLS_PER_LINE; j++) {
                this.drawCell(ctx, j, i, true);
            }
        }

        for (let i = 1; i < LINES; i += 2) {
            this.drawCell(ctx, 0, i, true);
            this.drawCell(ctx, 1, i, true);
        }

        for (let i = 2; i < CELLS_PER_LINE; i++) {
            this.drawCell(ctx, i, 1, true);
        }

        for (let i = 2; i < CELLS_PER_LINE - 1; i++) {
            this.drawCell(ctx, i, 3, true);
        }
    }
}