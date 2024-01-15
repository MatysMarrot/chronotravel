<!DOCTYPE html>
  <html lang="fr">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>ChronoTravel - Accueil</title>
      <link rel="stylesheet" href="style/style.css">
    </head>

    <body>

    <?php
      $currentPage = 'home';
      include(__DIR__.'/header.viewpart.php');
    ?>

    <aside id="home_button">
      <ul>
        <li id="create_party_button"><a href="#">Créer une partie</a></li>
        <li id="join_party_button"><a href="#">Rejoindre une partie</a></li>
        <li id="join_class_button"><a href="#">Rejoindre une classe</a></li>
      </ul>
    </aside>

    </body>
  </html>