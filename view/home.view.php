<!DOCTYPE html>
  <html lang="fr">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>ChronoTravel - Accueil</title>
      <link rel="stylesheet" href="../view/style/style.css">
    </head>

    <body>

    <?php
      $currentPage = 'home';
      include(__DIR__.'/header.student.viewpart.php');
    ?>

    <aside id="home_button">
      <ul>
        <li id="create_party_button"><a href="../controler/create.lobby.ctrl.php">Créer une partie</a></li>
        <li id="join_party_button"><a href="../controler/student.join.ctrl.php">Rejoindre une partie</a></li>
        <li id="join_class_button"><a href="../controler/student.join.classgroup.ctrl.php">Rejoindre une classe</a></li>
      </ul>
    </aside>

    </body>
  </html>