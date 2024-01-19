import {Party} from "../model/js/Party.mjs";

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

const partie = new Party(document.getElementById("board"), JSON.parse(json));
console.log(partie);
// La connexion est ouverte
socket.addEventListener("open", function (event) {
    console.log(session_loc.id);
});

// Écouter les messages
socket.addEventListener("close", function (event) {
    console.log("Connexion avec le serveur fermée: ", event.data);
});


socket.addEventListener("error", function (event) {
    console.log("Erreur: ", event.data);
    partie.drawPlayerPosition();
    //hideCanvas()
});

// Écouter les messages
socket.addEventListener("message", function (event) {
    //TODO : PASSER LES BAILS A L'OBJET PARTIE
});



