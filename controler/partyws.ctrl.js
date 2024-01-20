import {Party} from "../model/js/Party.mjs";
import {PlayerJoinsPacket} from "../model/js/packets/PlayerJoinsPacket.mjs";
import {retreiveSession, retrieveSessionFromDiv} from "../controler/utils/jsUtils.mjs";


// Créer une connexion WebSocket
const socket = new WebSocket("ws://192.168.14.112:1313");
const json = ("{\n" +
    "  \"partyId\": 1,\n" +
    "  \"owner\": 0,\n" +
    "  \"players\":[\n" +
    "    {\n" +
    "      \"id\": 0,\n" +
    "      \"login\": \"J1\"\n" +
    "    },\n" +
    "    {\n" +
    "      \"id\": 1,\n" +
    "      \"login\": \"J2\"\n" +
    "    },\n" +
    "    {\n" +
    "      \"id\": 2,\n" +
    "      \"login\": \"J3\"\n" +
    "    },\n" +
    "    {\n" +
    "      \"id\": 3,\n" +
    "      \"login\": \"J4\"\n" +
    "    }\n" +
    "  ]\n" +
    "}");

const partie = new Party(document.getElementById("board"), JSON.parse(json), socket);
console.log(partie);

// La connexion est ouverte
socket.addEventListener("open", function (event) {
    let packet = new PlayerJoinsPacket(session.id, session.partyId);
    packet.handle(socket);

});


// Écouter les messages
socket.addEventListener("close", function (event) {
    if (partie != null && partie.isOver) {
        alert("La partie est terminée !");
    }
    console.log("Connexion avec le serveur fermée: ", event.data);
});


socket.addEventListener("error", function (event) {
    if (window.confirm("Something went wrong...")){
        console.log("Erreur: ", event.data);

    }
    partie.drawPlayerPosition();
    //hideCanvas()
});

// Écouter les messages
socket.addEventListener("message", function (event) {
    console.log("event");
    let info;
    try {
        info = JSON.parse(event.data);
    } catch (error) {
        console.log("Could not parse " + event);
        return;
    }

    //Si pas d'action dans la data
    //Ne doit pas arriver mais on est prudent ici
    console.log("Valeur de action : " + info.action);
    if (info.action == null) {
        console.log("data.action EST NULL");
        return;
    }

    //Si c'est un packet create
    if (info.action === "create" && partie == null) {
        console.log("CREATION OBJET PARTIE");
        partie = new Party(document.getElementById("board"), info, socket);
        console.log(partie);
        console.log(info.action);
        console.log(info.partyid);
        return;
    }

    console.log(info);
    partie.handlePacket(info);


});



