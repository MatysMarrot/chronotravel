mkdir -p logs

(php ./serveurs/startPartyServer.php > ./logs/PartyServer.logs) &
(php ./serveurs/startLobbyServer.php > ./logs/LobbyServer.logs) &
