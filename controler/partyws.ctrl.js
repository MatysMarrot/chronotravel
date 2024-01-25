import {Party} from "../model/js/Party.mjs";
import {PlayerJoinsPacket} from "../model/js/packets/PlayerJoinsPacket.mjs";
import {retreiveSession, retrieveSessionFromDiv} from "../controler/utils/jsUtils.mjs";


// Créer une connexion WebSocket
const socket = new WebSocket("ws://192.168.14.112:1414");
const session = retrieveSessionFromDiv();
let partie = null;
// La connexion est ouverte
socket.addEventListener("open", function (event) {
    //Si le joueur n'est pas connecté
    if (session == null || session.id == null || session.partyId == null){
        window.location.href = "../controler/login.ctrl.php";
    }
    let packet = new PlayerJoinsPacket(session.id, session.partyId);
    packet.handle(socket);

});


// Écouter les messages
socket.addEventListener("close", function (event) {
    if (partie != null && partie.isOver) {
        alert("La partie est terminée !");
    }

    console.log("Connexion avec le serveur fermée: ", event.data);
    window.location.href = "../controler/home.ctrl.php";
});


socket.addEventListener("error", function (event) {
    if (window.confirm("Something went wrong...")) {
        window.location.href = "../controler/home.ctrl.php";
    }
    //hideCanvas()
});

// Écouter les messages
socket.addEventListener("message", function (event) {
   // console.log("event");
    let info;
    try {
        info = JSON.parse(event.data);
    } catch (error) {
        console.log("Could not parse " + event);
        return;
    }

    //Si pas d'action dans la data
    //Ne doit pas arriver mais on est prudent ici
  //  console.log("Valeur de action : " + info.action);
    if (info.action == null) {
        console.log("data.action EST NULL");
        return;
    }

    //Si c'est un packet create
    if (info.action === "create" && partie == null) {
     //   console.log("CREATION OBJET PARTIE");
        partie = new Party(document.getElementById("board"), info, socket);
      //  console.log(partie);
      //  console.log(info.action);
      //  console.log(info.partyid);
        return;
    }

   //console.log(info);
    partie.handlePacket(info);

});



