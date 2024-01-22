var divJSON = document.querySelector(".json");
var contenuJson = divJSON.textContent;
var objetJson = JSON.parse(contenuJson);
var statPerGame = objetJson.statPerGame;
var data = [
    {
        name: "Antiquité",
        points: []
    },
    {
        name: "Moyen-Age",
        points: []
    },
    {
        name: "Epoque Contemporaine",
        points: []
    },
    {
        name: "Temps Moderne",
        points: []
    }
];
for (var i=0; i < statPerGame.length; i++) {
    data[0].points.push({x:statPerGame[i].gamePlayed, y: Math.round((statPerGame[i].antiquityCorrectAnswer/statPerGame[i].antiquityAnswer) * 100)/100});
    data[1].points.push({x:statPerGame[i].gamePlayed, y: Math.round((statPerGame[i].middleAgeCorrectAnswer/statPerGame[i].middleAgeAnswer) * 100)/100});
    data[2].points.push({x:statPerGame[i].gamePlayed, y: Math.round((statPerGame[i].contemporaryCorrectAnswer/statPerGame[i].contemporaryAnswer) * 100)/100});
    data[3].points.push({x:statPerGame[i].gamePlayed, y: Math.round((statPerGame[i].modernCorrectAnswer/statPerGame[i].modernAnswer) * 100)/100});
}
console.log(data);
// Création du graphique avec JSCharting
JSC.Chart('chartDiv', {
    title_label_text: 'Évolution du ratio de bonnes réponses par époque',
    xAxis_label_text: 'Nombre de parties jouées',
    yAxis_label_text: 'Ratio de bonnes réponses',
    legend_visible: true,
    height: 300,
    yAxis_scale_minimum: 0,  // L'axe des ordonnées commence à 0
    yAxis_scale_maximum: 1,  // L'axe des ordonnées ne peut dépasser 1
    series: data
});