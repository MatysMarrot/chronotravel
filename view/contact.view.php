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
        <h1>Nous contacter</h1>
        
        
        
        <div class="formulaire">
            <p>Pour toute question, contactez nous par mail 
            <a href="mailto:chronotravel@game.fr">chronotravel@game.fr</a>.<br> <br>Ou en utilisant le formulaire ci-dessous: </p>
            <form>
 
                <label for="email">Email :</label>
                <input type="text" id="email" name="email" required>
                
                <label for="message">Message :</label>
                <textarea id="message" name="message" required></textarea>
                
                <input type="submit" value="Envoyer">
            </form>
        </div>


        </main>

        <footer>
            <?php include(__DIR__.'/footer.viewpart.php'); ?>
        </footer>
    </body>
</html>