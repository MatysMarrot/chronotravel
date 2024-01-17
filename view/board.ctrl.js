var table = document.getElementById("board");
var toutesLesCelulles = [];

// Ajouter des lignes au tableau
for (var i = 0; i < 5; i++) {
    var row = table.insertRow(i);

    // Ajouter des cellules à chaque ligne
    for (var j = 0; j < 10; j++) {
        var cell = row.insertCell(j);
        cell.textContent = i * 10 + j;
    }
}


//Ajoute la classe "board_avalaible" aux cellule une ligne/2
for (var lign = 0; lign < table.rows.length; lign += 2){

    var row = table.rows[lign];

    for (var coll = 0; coll < row.cells.length ; coll++){
        row.cells[coll].classList.add('board_available');
        toutesLesCelulles.push(row.cells[coll]);
    }

}

//Ajoute les cellules "descendante" du chemin
var dg = false;
var position = 0;
for (var i = 1; i < table.rows.length; i+=2) {
    (dg ? position = 0 : position = row.cells.length -1);
    var row = table.rows[i];
    var cellule = row.cells[position];

    cellule.classList.add('board_available');
    toutesLesCelulles.push(cellule);

    dg = !dg;
}


var id = 0;
toutesLesCelulles.forEach(element => {element.id = id;
    id++;
});


