
/*Table role
Contrainte: content en majuscule
*/
CREATE TABLE Role (
    id serial PRIMARY KEY,
    content VARCHAR(5) CHECK (content = UPPER(content))
);

/*Table Person:
Info: Password est le hash du mot de passe, jamais le mot de passe
    - creation date est la date courante si pas donnée
*/
CREATE TABLE Person (
    id serial PRIMARY KEY,
    roleID int REFERENCES Role(id) NOT NULL,
    lastName varchar(30),
    name varchar(30),
    login varchar(30),
    password varchar(64),
    email varchar(50),
    currency int,
    creationDate DATE DEFAULT CURRENT_DATE,
    birthdate DATE
);

/*Table Class:
Info: creation date est la date courante si pas donnée
*/
CREATE TABLE Class (
    id serial PRIMARY KEY,
    name varchar(30),
    creationDate DATE DEFAULT CURRENT_DATE,
    code varchar(5)
);

/*Table StudentClass:*/
CREATE TABLE StudentClass (
    studentId INT PRIMARY KEY REFERENCES Person(id) NOT NULL,
    classId INT REFERENCES Class(id)
);


/*Table ClassTeacher:*/
CREATE TABLE ClassTeacher (
    classId INT PRIMARY KEY REFERENCES Class(id) NOT NULL,
    teacherId INT REFERENCES Person(id)
);


/*Table PartyState:
Contrainte: content en majuscule
*/
CREATE TABLE PartyState (
    id SERIAL PRIMARY KEY,
    content VARCHAR(5) CHECK (content = UPPER(content))
);

/*Table Theme:
Contrainte: content en majuscule
*/
CREATE TABLE Theme (
    id SERIAL PRIMARY KEY,
    content VARCHAR(10) CHECK (content = UPPER(content))
);

/*Table Party:
INFO : Une foreign key peut etre nulle, donc on spécifie pas
*/
CREATE TABLE Party (
    id SERIAL PRIMARY KEY,
    partyState INT REFERENCES PartyState(id),
    theme INT REFERENCES Theme(id),
    creatorId INT REFERENCES Person(id) NOT NULL,
    member2id INT REFERENCES Person(id),
    member1id INT REFERENCES Person(id),
    member3id INT REFERENCES Person(id),
    date DATE DEFAULT CURRENT_DATE 
);

CREATE TABLE PartyStudent (
    studentId INT PRIMARY KEY REFERENCES Person(id) NOT NULL,
    partyId INT REFERENCES Party(id) NOT NULL
);

/*Table de lien etre un code de partie et une partie:
Contrainte: Code unique contenant seulement des lettres et sans I ou O
*/

CREATE TABLE PartyCode(
    code varchar(5) primary key CHECK (code SIMILAR TO '%[A-HJ-NP-Z]{5}%'),
    partyId INT REFERENCES Party(id) NOT NULL

);

/*Table History:
Contraintes: position entre 1 et 3
*/
CREATE TABLE History (
    partyId INT NOT NULL,
    playerId INT NOT NULL,
    position INT CHECK (1 <= position AND position <= 4),
    nbrRightAnswers INT,
    PRIMARY KEY (partyId, playerId),
    FOREIGN KEY (partyId) REFERENCES Party(id),
    FOREIGN KEY (playerId) REFERENCES Person(id)
);

/*Table Question:*/
CREATE TABLE Questions (
    id SERIAL PRIMARY KEY,
    content VARCHAR(180),
    themeId INT REFERENCES Theme(id)
);

/*Table Awnsers:*/
CREATE TABLE Answers (
    id SERIAL PRIMARY KEY,
    questionId INT REFERENCES Questions(id),
    content VARCHAR(100),
    correct BOOLEAN
);

/* Table skinpart */
CREATE TABLE SkinPart (
    skinPartId SERIAL PRIMARY KEY,
    name varchar(20) NOT NULL
);

/* Table skinobject */
CREATE TABLE SkinObject (
    skinId SERIAL PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    price INT NOT NULL,
    location varchar(100) NOT NULL,
    parts INT REFERENCES skinPart(skinPartId)
);

/* Table currentSkin */
CREATE TABLE currentSkin (
    playerId INT REFERENCES Person(id),
    hat INT REFERENCES SkinObject(skinId),
    hair INT REFERENCES SkinObject(skinId),
    teeshirt INT REFERENCES SkinObject(skinId),
    pants INT REFERENCES SkinObject(skinId),
    shoes INT REFERENCES SkinObject(skinId),
    skinColor varchar(6) NOT NULL
);

/* Table player/skin */
CREATE TABLE PlayerSkin (
    playerId INT REFERENCES Person(id),
    skinId INT REFERENCES SkinObject(skinId),
    PRIMARY KEY (playerId, skinId)
);

CREATE TABLE Stat (
    playerId INT REFERENCES Person(id),
    won BOOLEAN DEFAULT false,
    AncientHistoryScore INT DEFAULT 0,
    MiddleAgesScore INT DEFAULT 0,
    ModernHistoryScore INT DEFAULT 0,
    ContemporaryScore INT DEFAULT 0,
    AncientHistoryCorrectAnswers INT DEFAULT 0,
    MiddleAgesCorrectAnswers INT DEFAULT 0,
    ModernHistoryCorrectAnswers INT DEFAULT 0,
    ContemporaryCorrectAnswers INT DEFAULT 0,
    partyid INT,
    PRIMARY KEY (playerId,partyid)
);