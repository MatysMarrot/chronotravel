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
            <h1>Lancement de la partie</h2>
            <p>Partagez ce code pour inviter à jouer: <span class="bold">JSHH5</span></p>
            
            <p>Temps restant: <span class="countdown"></p>
            <script src="../controler/countdown.lobby.ctrl.js"></script>
            <img class="skin" src="../../skin.png" alt="">    
            <h2>Pseudo</h2>
            <label for="code">Liste des autres joueurs:</label>
            <section>
                <!-- Inclure php pour afficher les élèves-->
                <ul class="ul_horizontal">
                    <li ><p>en attente j2</p></li>
                    <li ><p>en attente j3</p></li>
                    <li ><p>en attente j4</p></li>
                </ul>
            </section>

            <div class="button-container">
                <button class="button">QUITTER</button>
                <button class="button">LANCER</button>
            </div>
        </main>

        <footer>
            <?php include(__DIR__.'/footer.viewpart.php'); ?>
        </footer>
    </body>
</html>