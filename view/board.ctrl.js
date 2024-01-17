var table = document.getElementById("board");
var toutesLesCelulles = [];

const CELPERLINE = 10;
const LINES = 5;
/*
// Ajouter des lignes au tableau
for (var i = 0; i < LINES; i++) {
    var row = table.insertRow(i);

    // Ajouter des cellules à chaque ligne
    for (var j = 0; j < CELPERLINE; j++) {
        var cell = row.insertCell(j);
    }
}

// Ajoute la classe "board_avalaible" aux cellules d'une ligne sur 2
for (var lign = 0; lign < table.rows.length; lign += 2) {
    var row = table.rows[lign];

    for (var coll = 0; coll < row.cells.length; coll++) {
        row.cells[coll].classList.add('board_available');
        toutesLesCelulles.push(row.cells[coll]);
    }
}

// Ajoute les cellules "descendantes" du chemin
var dg = false;
var position = 0;
for (var i = 1; i < table.rows.length; i += 2) {
    (dg ? position = 0 : position = row.cells.length - 1);
    var row = table.rows[i];
    var cellule = row.cells[position];

    cellule.classList.add('board_available');
    toutesLesCelulles.push(cellule);

    dg = !dg;
}

// Attribue des identifiants uniques à chaque cellule
var id = 0;

for (const cellule of toutesLesCelulles) {
    cellule.id = "cell_" + id;
    cellule.textContent = id;
    id++;
}

*/
function showCanvas() {
    const canvas = document.getElementById("myCanvas");
    canvas.style.display = "block";
    resizeCanvas();
    drawCanvas();
}

function resizeCanvas() {
    const canvas = document.getElementById("myCanvas");
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
}

function drawCell(ctx, x, y, isAvailable) {
    ctx.beginPath();
    ctx.rect(x * CELL_SIZE, y * CELL_SIZE, CELL_SIZE, CELL_SIZE);
    ctx.fillStyle = isAvailable ? "green" : "white";
    ctx.fill();
    ctx.stroke();
}

function drawCanvas() {
    const canvas = document.getElementById("myCanvas");
    const ctx = canvas.getContext("2d");

    const CELLS_PER_LINE = 10;
    const LINES = 5;
    const CELL_SIZE = canvas.width / CELLS_PER_LINE;

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

window.addEventListener('resize', function () {
    if (document.getElementById("myCanvas").style.display === "block") {
        resizeCanvas();
        drawCanvas();
    }
});

window.onload = showCanvas;

