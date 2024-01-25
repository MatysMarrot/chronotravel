<!DOCTYPE html>
  <html lang="fr">
    <head>
      <meta charset="UTF-8">
      <title>Chrono Travel- Salle d'attente</title>
      <link rel="stylesheet" type="text/css" href="../view/style/style.css">    
    </head>

    <body>
        <!--Header --> 
        <?php include(__DIR__.'/header.student.viewpart.php'); ?>

        <main>
            <h1>Lancement de la partie</h1>
            <!-- Arriver sur cette page une nouvelle partie est créer et un code est généré automatiquement-->
            <p>Partagez ce code pour inviter à jouer: <span class="bold">"<?=$_SESSION['roomCode']?>"</span></p>


            <p id ="error"></p>
            <img class="skin" src="./assets/background.png" alt="">    
            <h2 id="player1">Pseudo</h2>
            <label for="code">Liste des autres joueurs:</label>
            <section class="lobby">
                <!-- Inclure php pour afficher les élèves qui rejoignent en temps réel-->
                <ul class="ul_horizontal">
                    <li ><p id="player2">en attente j2</p></li>
                    <li ><p id="player3">en attente j3</p></li>
                    <li ><p id="player4">en attente j4</p></li>
                </ul>
            </section>

            <div class="button-container">
                <button class="button2" onclick="leave()">QUITTER</button> <!-- Retourne à la page d'accueil et supprimer la partie créer -->
                <?php if($isOwner) : ?>
                <button class="button2" onclick="start()">LANCER</button>
                </div>
                <?php else : ?>
                    </div>
                <p>En attente du créateur du groupe</p>
                <?php endif;?>

        </main>

        <!--Footer -->
        <?php include(__DIR__.'/footer.viewpart.html'); ?>
        <script src="../controler/lobby.ctrl.js"></script>
    </body>
</html>