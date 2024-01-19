//import "./controler/jsUtils";

//to retreive the php session
const session_loc = fetch("../serveurs/retreiveSession.php", {
    method: "POST",
    headers: {
        "Content-type": "application/json; charset=UTF-8"
    }
}).then(reponse => {return reponse.json()}).valueOf();
const socket = new WebSocket("ws://192.168.14.112:1312"); // Créer une connexion WebSocket

//Emplacements des pseudo pour changer le nom
const pseudoEmplacements = [document.getElementById("player1"),
    document.getElementById("player2"),
    document.getElementById("player3"),
    document.getElementById("player4")
];

function leave(){
    socket.close();
    window.location.href = "./home.ctrl.php";
}

function start(){
    session_loc.then(function(session){
        let clientId = session.id;
        let partyId = session.partyId;
        let login = session.login;

        //Si on ne trouve pas un des deux en session
        if (partyId == null || clientId == null){
            socket.close(0, "Unable to find pid or cid !");
            console.log("Unable to find pid or cid !");
            window.location("./waitroom.ctrl.php");
        }

        data = {
            cid: clientId,
            pid: partyId,
            login: login,
            action: "START",
        }

        socket.send(JSON.stringify(data));
    });
}

// La connexion est ouverte
socket.addEventListener("open", function (event) {
    session_loc.then(function(session){
        let clientId = session.id;
        let partyId = session.partyId;
        let login = session.login;

        //Si on ne trouve pas un des deux en session
        if (partyId == null || clientId == null){
            socket.close(0, "Unable to find pid or cid !");
            console.log("Unable to find pid or cid !");
            window.location("./waitroom.ctrl.php");
        }

        data = {
            cid: clientId,
            pid: partyId,
            login: login,
            action: "JOIN",
        }

        socket.send(JSON.stringify(data));



    });

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
    let data;
    try {
        data = JSON.parse(event.data);
    } catch (error){
        console.log("Could not parse: " + event.data);
    }

    switch (data.action) {
        case "playerJoin":
            console.log(data);
            for (let i = 0; i < data.names.length; i++) {
                pseudoEmplacements.at(i).textContent = data.names[i];
            }
            break;
        case "start":
            window.location.href = "../controler/board.ctrl.php";
    }
});


  
