<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Scooby Gang" />
    <link rel="stylesheet" type="text/css" href="../view/style/style.css">
    <title>Chrono Travel- Règles du jeu</title>
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
            Au début du jeu, vous serez placés sur un plateau. Le plateau est voué à se transformer pour s’adapter à 4 époques : 
            l’antiquité, le moyen-âge, l'époque contemporaine et l’époque moderne.
        </p>
        <h2>But du jeu :</h2>
        <p>
            Vous devrez vous déplacer en ayant les bonnes réponses aux questions et arriver en premier sur la case finale du plateau.        
        </p>
        <h2>Lancement de la Partie :</h2>
        <p>
            Vous pouvez créer une partie ou rejoindre en rejoindre une à l'aide d'un code que vos amis vous aurons partager. Vous serez alors placé dans une salle d'attente jusqu'à ce que le joueur qui a créé la partie la lance. 
            Le créateur de la partie peut lancer la partie même s'il n'y a pas 4 personnes, la partie sera alors complétée par des robots.
        </p>
        <h2>Composition du plateau :</h2>
        <p>
            Le plateau est composé de cases Pièce et de cases Événements. Les cases Pièce sont des cases qui permettent de gagner ou de perdre un certain nombre de 
            pièces. A la fin de la partie, un certain pourcentage de ces pièces vous seront données. Les cases Événements déclenche différents types d'événement qui 
            peuvent être aussi bien positif que négatif pour vous.
        </p>
        <h2>Le processus de tour :</h2>
        <p>
            À chaque début de tour, une épreuve aléatoire est choisie parmi les mini-jeux, tous les joueur aurons le même mini-jeu. 
            Le joueur ayant gagné le mini-jeu ira le plus loin sur le plateau, le dernier quant à lui ira le moins loin. Ainsi, c'est le classement des joueurs 
            lors des mini-jeu qui influencera le nombre de cases parcourues. Le premier lors du mini-jeu se déplacera en premier, puis le deuxième et ainsi de suite. 
            En cas d'égalité entre plusieurs joueurs, le joueur étant le plus loin sur le plateau commencera. Ainsi, une fois que tous les joueurs se sont déplacés, 
            le tour est terminé et un autre commence.
        </p>
        <h2>Les mini-jeux :</h2>
        <p>
            Les questions posées lors des minis-jeux dépendent du thème actuel du plateau (Antiquité, Moyen-Âge, époque contemporaine et l’époque moderne).
            <ul>
                <li><strong>Quiz classique :</strong> Vous devrez répondre correctement aux séries questions. Le classement sera établi en fonction du nombre de bonnes réponses obtenus par les joueurs.</li>
                <li><strong>Image à deviner :</strong> Une série d'images historiques (lieux, personnages historiques…) vous sera affiché , vous devrez écrire à quoi correspondent ces images. Le classement sera établi en fonction du nombre de bonnes réponses obtenus par les joueurs.</li>
                <li><strong>Complétion de phrase :</strong> Une série des phrases à trous apparaitra à l’écran. Vous devrez compléter les phrases correctement. Le classement sera établi en fonction du nombre de bonnes réponses obtenus par les joueurs.</li>
                <li><strong>Bomb party :</strong> Vous devrez donner tour à tour des mots/noms relatifs à un thème donné dans un temps imparti. A la fin du temps, le joueur qui devait répondre sera éliminir. Le classement sera établi en fonction de l’ordre dans lequel les joueurs sont éliminer pendant la partie.</li>
            </ul>
        </p>
        <h2>Récompenses :</h2>
        <p>
            Les ChronoCoins sont une monnaie fictive du jeu, à la fin d’une partie vous gagnerez des pièces en fonction de votre classement. Grâce à ses pièces, vous pourrez acheter des cosmétiques en tout genre (comme des tenues, chapeaux, lunettes, accessoires…) pour personnaliser votre personnage en jeu.
        </p>
    </main>
    <?php include(__DIR__.'/footer.viewpart.html')?>
</body>
</html>
