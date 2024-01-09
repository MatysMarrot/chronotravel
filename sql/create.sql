
/*Table role
Contrainte: Libelle en majuscule
*/
CREATE TABLE Role (
    id serial PRIMARY KEY,
    libelle VARCHAR(5) CHECK (libelle = UPPER(libelle))
);

/*Table Person:
Info: Password est le hash du mot de passe, jamais le mot de passe
    - creation date est la date courante si pas donnée
*/
CREATE TABLE Person (
    id serial PRIMARY KEY,
    roleID int REFERENCES Role(id) NOT NULL,
    nom varchar(30),
    prenom varchar(30),
    login varchar(30),
    password varchar(64),
    currency int,
    creationDate DATE DEFAULT CURRENT_DATE,
    birthdate DATE
);

/*Table Class:
Info: creation date est la date courante si pas donnée
*/
CREATE TABLE Class (
    id serial PRIMARY KEY,
    nom varchar(30),
    creationDate DATE DEFAULT CURRENT_DATE
);

/*Table StudentClass:*/
CREATE TABLE StudentClass (
    studentId INT PRIMARY KEY REFERENCES Person(id) NOT NULL,
    classId INT REFERENCES Class(id)
);


/*Table ClassTeacher:*/
CREATE TABLE ClasseProf (
    classId INT PRIMARY KEY REFERENCES Class(id) NOT NULL,
    teacherId INT REFERENCES Person(id)
);


/*Table PartyState:
Contrainte: Libelle en majuscule
*/
CREATE TABLE PartyState (
    id SERIAL PRIMARY KEY,
    libelle VARCHAR(5) CHECK (libelle = UPPER(libelle))
);

/*Table Theme:
Contrainte: Libelle en majuscule
*/
CREATE TABLE Theme (
    id SERIAL PRIMARY KEY,
    libelle VARCHAR(10) CHECK (libelle = UPPER(libelle))
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

/*Table Party:
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
    libelle VARCHAR(180),
    theme_id INT REFERENCES Theme(id)
);

/*Table Awnsers:*/
CREATE TABLE Answers (
    id SERIAL PRIMARY KEY,
    questionId INT REFERENCES Questions(id),
    libelle VARCHAR(100),
    correct BOOLEAN
);

