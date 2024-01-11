<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Scooby Gang" />
    <link rel="stylesheet" type="text/css" href="style/login.css">
    <title>Acceuil</title>
</head>
<body id="">
    <header class="connectionpage">
        <a href="rules.view.php" class="active">Règles</a>
        <a href="landingpage.php"><h1>Chronotravel</h1></a>
        <a href="contact.view.php">Contact</a>
    </header>
    <main class="rulespage">
        <h2>Contexte :</h2>
        <p>
            Les joueurs sont placés sur un plateau au début de celui-ci. Ce dernier est voué à changer pour s’adapter aux 4 époques étudiées lors du cycle 4 (l’antiquité, le moyen-âge, le après révolution française et l’époque contemporaine).
        </p>
        <h2>But du jeu :</h2>
        <p>
            Les joueurs se déplacent sur le plateau et doivent arriver en premier sur la case finale du plateau.        
        </p>
        <h2>Lancement de la Partie :</h2>
        <p>
            Les élèves peuvent créer une partie. Ils seront alors placés dans une salle d'attente où ils pourront inviter leurs amis ou camarades de classe en leur envoyant le code de la salle d'attente. Ils peuvent lancer la partie même s'il n'y a pas 4 personnes, la partie sera alors complétée par des robots.
        </p>
        <h2>Composition du plateau :</h2>
        <p>
            Le plateau est composé de cases Pièce et de cases Événements. Les cases Pièce sont des cases basiques qui permettent de gagner ou de perdre un certain nombre de pièces. A la fin de la partie, un certain pourcentage de ces pièces sont données au joueur. Les cases Événements permettent le déplacement du joueur sur le plateau (en avançant ou en reculant), le changement du thème du plateau entraînant le changement du thème des questions etc...
        </p>
        <h2>Le processus de tour :</h2>
        <p>
            À chaque début de tour, une épreuve aléatoire est choisie parmi les mini-jeux, chaque joueur aura le même mini-jeu, mais chacun sur son propre écran. Le joueur ayant gagné le mini-jeu ira le plus loin sur le plateau, le dernier quant à lui ira le moins loin. Ainsi, le classement du mini-jeu influencera sur le nombre de cases parcourues. Le premier se déplace en premier, le deuxième ensuite etc… En cas d’ex aequo entre plusieurs joueurs, le joueur le plus haut au classement général commence. Ainsi, une fois que tous les joueurs se sont déplacés, le tour est terminé, et le suivant démarre.
        </p>
        <h2>Les mini-jeux :</h2>
        <p>
            Le thème des minis-jeux dépend du thème actuel du plateau (un mini-jeu lié au moyen-âge si le plateau est en état moyen-âge etc …)
            <ul>
                <li><strong>Quiz classique :</strong> Répondre correctement aux séries questions rapporte des points. Le classement sera établi en fonction du nombre de points obtenus par les joueurs.</li>
                <li><strong>Image à deviner :</strong> Une série d'images historiques (lieux, personnages historiques…)est montrée aux joueurs, ils doivent écrire à quoi correspondent ces images. Les réponses justes rapportent des points. Le classement sera établi en fonction du nombre de points obtenus par les joueurs.</li>
                <li><strong>Complétion de phrase :</strong> Des phrases à trous apparaissent à l’écran. Les joueurs doivent remplir les cases correctement. Les réponses justes rapportent des points. Le classement sera établi en fonction du nombre de points obtenus par les joueurs.</li>
                <li><strong>Bomb party :</strong> Les élèves doivent donner des mots/noms relatifs à un thème donné tour à tour. Au bout du temps imparti symbolisé par une bombe sur le point d’exploser, la bombe explose sur eux ce qui cause leur élimination. Le classement sera établi en fonction de l’ordre dans lequel les joueurs perdent la partie.</li>
            </ul>
        </p>
        <h2>Récompenses :</h2>
        <p>
            Les pièces sont une monnaie fictive du jeu, à la fin d’une partie un joueur gagne des pièces. Grâce à ses pièces, ils peuvent acheter des cosmétiques en tout genre (comme des tenues, chapeaux, lunettes, accessoires…) pour personnaliser leur personnage en jeu. C’est un moyen de motiver les élèves à réviser leur Brevet.
        </p>
    </main>
    <?php include(__DIR__.'/footer.viewpart.html')?>
</body>
</html>
