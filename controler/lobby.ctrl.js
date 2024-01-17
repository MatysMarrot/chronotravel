// Créer une connexion WebSocket
const socket = new WebSocket("ws://192.168.14.112:1312");

// La connexion est ouverte
socket.addEventListener("open", function (event) {
    let clientId = sessionStorage.getItem("id");
    let partyId = sessionStorage.getItem("partyid");

    //Si on ne trouve pas un des deux en session
    if (partyId == null || clientId == null){
        socket.close(reason="Unable to find pid or cid !");
        console.log("Unable to find pid or cid !");
        window.location("./waitroom.ctrl.php");
    }

    data = {
        cid: clientId,
        pid: partyId,
        action: "JOIN",
    }

    socket.send(JSON.stringify(data));
});

// Écouter les messages
socket.addEventListener("close", function (event) {
    console.log("Connexion avec le serveur fermée: ", event.data);
});


socket.addEventListener("error", function (event) {
    console.log("Erreur: ", event.data);
});

// Écouter les messages
socket.addEventListener("message", function (event) {
  console.log("Voici un message du serveur", event.data);
});


  
