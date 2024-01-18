const CELPERLINE = 10;
const LINES = 5;
const CELL_SIZE = 10;

export class Board {
    canva;
    constructor(canva) {
        if (!canva instanceof HTMLElement){
            throw new Error("canva should be HTMLElement not " + canva.className);
        }

        this.canva = canva;
    }

    showCanvas() {
        this.canva.style.display = "block";
        resizeCanvas();
        drawCanvas();
    }

    hideCanvas() {
        this.canva.style.display = "none";
    }

    resizeCanvas() {
        this.canva.width = window.innerWidth;
        this.canva.height = window.innerHeight;
    }

    drawCell(ctx, x, y, isAvailable) {
        ctx.beginPath();
        ctx.rect(x * CELL_SIZE, y * CELL_SIZE, CELL_SIZE, CELL_SIZE);
        ctx.fillStyle = isAvailable ? "green" : "white";
        ctx.fill();
        ctx.stroke();
    }

    drawCanvas() {
        const ctx = this.canva.getContext("2d");

        const CELLS_PER_LINE = 10;
        const LINES = 5;
        const CELL_SIZE = this.canva.width / CELLS_PER_LINE;

        for (let i = 0; i < LINES; i++) {
            for (let j = 0; j < CELLS_PER_LINE; j++) {
                drawCell(ctx, j, i, true);
            }
        }

        for (let i = 1; i < LINES; i += 2) {
            drawCell(ctx, 0, i, true);
            drawCell(ctx, 1, i, true);
        }

        for (let i = 2; i < CELLS_PER_LINE; i++) {
            drawCell(ctx, i, 1, true);
        }

        for (let i = 2; i < CELLS_PER_LINE - 1; i++) {
            drawCell(ctx, i, 3, true);
        }
    }

    //TODO :
    /*window.addEventListener('resize', function () {
        if (document.getElementById("myCanvas").style.display === "block") {
            resizeCanvas();
            drawCanvas();
        });
    }*/
}