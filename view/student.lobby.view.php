<!DOCTYPE html>
  <html lang="fr">
    <head>
      <meta charset="UTF-8">
      <title>Chrono Travel- Salle d'attente</title>
      <link rel="stylesheet" type="text/css" href="./style/style.x.css">
    </head>

    <body>
        <!--Header --> 
        <?php include(__DIR__.'/header.viewpart.php'); ?>

        <main>
            <h1>Lancement de la partie</h2>
            <p>Partagez ce code pour inviter à jouer: <span class="bold">JSHH5</span></p>
            
            <p>Temps restant: <span class="countdown"></p>
            <script src="../controler/countdown.lobby.ctrl.js"></script>
            <img class="skin" src="./assets/background.png" alt="">    
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

        <!--Footer -->
        <?php include(__DIR__.'/footer.viewpart.html'); ?> 
    </body>
</html>