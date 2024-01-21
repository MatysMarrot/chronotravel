Documentation: Les packets
=


Introduction :
-
    Pour que les actions arrivent au même moment pour tous les joueurs, nous devons établir
    une connexion web socket entre Javascript et PHP.

    Pour que les messages soient compréhensibles par les deux languages, ils doivent être
    formaté au préalable en json (pour avoir une syntaxe commune)

Documentations externes:
-
[Ratchet](http://socketo.me/): API de Websocket coté PHP
___

## Les packets et leurs formes:

### AbstractPacket

```json
{
  "action": "",
  "id": -1,
  "partyId": 1
}
```

### PlayerJoinsPacket

```json
{
  "action": "join",
  "id": 1,
  "partyId": 1
}
```

* **_id_**: id de l'utilisateur envoyant le packet (-1 si le packet vient du serveur)
* **_partyid_** : id de la partie à laquelle le packet appartient

### VictoryPacket

```json
{
  "action": "victory",
  "id": -1,
  "partyId": 1,
  "winners": [
    {
      "id": 1
    },
    {
      "id": 2
    }...
  ]
}
```
* _**winners**_: Liste des id des joueurs sur la case finale

### MovementPacket

```json
{
  "action": "movement",
  "id": -1,
  "partyId": 1,
  "players":[
    {
      "id": 0,
      "movement": 4
    },
    {
      "id": 1,
      "movement": 2
    },
    {
      "id": 2,
      "movement": 1
    },
    {
      "id": 3,
      "movement": 0
    }
  ]
}
```
* **_players_**: Liste des joueurs et le nombre de cases duquel ils doivent avancer




