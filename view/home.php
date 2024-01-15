<!DOCTYPE html>
  <html lang="fr">
    <head>
      <meta charset="UTF-8">
      <title></title>
      <link rel="stylesheet" href="style/header_style.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    </head>

    <body>

    <?php
      $currentPage = 'home';
      include(__DIR__.'/header.viewpart.php');
    ?>

    <aside>
      <ul>
        <li id="create_party_button"><a href="#">Créer une partie</a></li>
        <li id="join_party_button"><a href="#">Rejoindre une partie</a></li>
      </ul>
      <ul>
        <li id="join_class_button"><a href="#">Rejoindre une classe</a></li>
      </ul>
    </aside>

    </body>
  </html>