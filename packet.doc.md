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

### PlayerLeavePacket
```json
{
  "action": "leave",
  "id": 1,
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


### CreatePartyPacket
```json
{
  "action": "create",
  "id": -1,
  "partyId": 1,
  "owner": 0,
  "players":[
    {
      "id": 0,
      "login": "J1"
    },
    {
      "id": 1,
      "login": "J2"
    },
    {
      "id": 2,
      "login": "J3"
    },
    {
      "id": 3,
      "login": "J4"
    }
  ]
}
```

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

### AnswerPacket

```json
{
  "action": "answer",
  "id": 1,
  "partyId": 1,
  "nbrQuestions": 10,
  "nbrRightAnswers": 5
}
```
* **_nbrQuestions_**: Nombre de questions auquel l'utilisateur a répondu
* **_nbrRightAnswers_**: Nombre bonnes réponses


### QuestionPacket
```json
{
  "action": "question",
  "id": 1,
  "partyid":  1,
  "questions": [
    {
      "type": 1,
      "id": 1,
      "themeId": 1,
      "content": "QUESTION 1",
      "reponses": [
        {
          "id" : 1,
          "quesitonId": 1,
          "content": "LA REPONSES A",
          "right": true
        },
        {
          "id" : 2,
          "quesitonId": 1,
          "content": "LA REPONSES B",
          "right": false
        }

      ]
    },
    {
      "type": 2,
      "id": 10,
      "themeId": 1,
      "content": "QUESTION AVEC IMAGE",
      "image": "IMAGE EN BASE 64",
      "reponses": [
        {
          "id" : 10,
          "quesitonId": 10,
          "content": "LA REPONSES A",
          "right": true
        },
        {
          "id" : 11,
          "quesitonId": 10,
          "content": "LA REPONSES B",
          "right": false
        }
      ]
    }
  ]
}
```
* **_questions_**: Array de questions
* **_reponses_**: reponses possibles à la question

**ATTENTION /!\\:** Deux types de paquets questions:
* **1**: QCM classique
* **2**: QCM avec image



### AnswerPacket
```json
{
  "action": "answer",
  "id": 1,
  "partyId": 1,
  "nbrQuestions": 10,
  "nbrRightAnswers": 5
}
```
* **_nbrQuestions_**: Nombre de questions auquel l'utilisateur a répondu
* **_nbrRightAnswers_**: Nombre bonnes réponses




