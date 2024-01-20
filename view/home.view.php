<!DOCTYPE html>
  <html lang="fr">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>ChronoTravel - Accueil</title>
      <link rel="stylesheet" href="./style.css">
    </head>

    <body>

    <?php
    $currentPage = 'home';
    include(__DIR__.'/header.student.viewpart.php');
    ?>

    <main id="home">
        <h1>Chronotravel</h1>
        <p>Embarquez pour un voyage dans le temps avec notre jeu de plateau multijoueur. Relevez des défis éducatifs
            et explorez les époques. Prêt à devenir le maître de l'histoire?</p>
        <section>
            <ul class="menu-home">
                <li ><a class="button-home" href="../controler/create.lobby.ctrl.php">Créer une partie</a></li>
                <li ><a class="button-home" href="../controler/student.join.ctrl.php">Rejoindre une partie</a></li>
                <li ><a class="button-home" href="../controler/student.join.classgroup.ctrl.php">Rejoindre une classe</a></li>
            </ul>
        </section>
        <p>Vous ne savez pas comment jouer ? <a href="../controler/rules.ctrl.php">Cliquez ici !</a></p>

    </main>


    </body>
  </html>