class Party{

    id;
    owner;
    players;
    playersPosition;

    constructor(json) {
        this.id = json.id;
        this.owner = json.owner;
        this.players = json.players;
        this.playersPosition = json.playersPosition;
    }

    get id() {
        return this.id;
    }

    get owner() {
        return this.owner;
    }

    get players() {
        return this.players;
    }

    get playersPosition() {
        return this.playersPosition;
    }

}