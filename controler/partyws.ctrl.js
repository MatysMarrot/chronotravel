import {Party} from "../model/js/Party.mjs";
import {PlayerJoinsPacket} from "../model/js/packets/PlayerJoinsPacket.mjs";
import {retreiveSession} from "../controler/utils/jsUtils.mjs";

// Créer une connexion WebSocket
const socket = new WebSocket("ws://192.168.14.112:1414");
let partie = null;

// La connexion est ouverte
socket.addEventListener("open", function (event) {
    retreiveSession().then(function (result){
        let packet = new PlayerJoinsPacket(result.id, result.partyid);
        console.log(packet);
        packet.handle(socket);
    });
});


// Écouter les messages
socket.addEventListener("close", function (event) {
    if (partie != null && partie.isOver){
        alert("La partie est terminée !");
    }
    console.log("Connexion avec le serveur fermée: ", event.data);
});


socket.addEventListener("error", function (event) {
    if (window.confirm("Something went wrong...")) {
        console.log("Erreur: ", event);
    }
    //hideCanvas()
});

// Écouter les messages
socket.addEventListener("message", function (event) {
    console.log("event");
    let data;
    try {
        data = JSON.parse(event.data);
    } catch (error){
        console.log("Could not parse " + event);
        return;
    }

    //Si pas d'action dans la data
    //Ne doit pas arriver mais on est prudent ici
    if (data.action == null){
        return;
    }

    //Si c'est un packet create
    if (data.action === "create" && partie == null){
        partie = new Party(document.getElementById("board"), data, socket);
        return;
    }

    partie.handlePacket(data);

});



