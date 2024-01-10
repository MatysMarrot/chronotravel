<!DOCTYPE html>
  <html lang="fr">
    <head>
      <meta charset="UTF-8">
      <title>Chrono Travel- Salle d'attente</title>
      <link rel="stylesheet" type="text/css" href="./style/style.x.css">
    </head>

    <body>
        
        <header>
            <nav>
                <ul class="ul_horizontal">
                    <li ><a class="actif" href="#">ACCUEIL</a></li>
                    <li><a href="#">MON PROFIL</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">CONTACT</a></li>
                </ul>
            </nav>
            <?php include(__DIR__.'/header.viewpart.php'); ?>

        </header>

        <main>
            <h1>Rejoindre une partie</h2>
                
            <img class="skin" src="../../skin.png" alt="">
                
            <h2>Pseudo</h2>
            <label for="code">Entrez le code de la partie pour la rejoindre:</label>
            <input type="text" id="code" name="code" required minlength="5" maxlength="5" size="20" />
            <button type="submit" >REJOINDRE</button>
            
        </main>

        <footer>
            <?php include(__DIR__.'/footer.viewpart.php'); ?>
        </footer>
    </body>
</html>