<!DOCTYPE html>
  <html lang="fr">
    <head>
      <meta charset="UTF-8">
      <title>Chrono Travel- Rejoindre une partie</title>
      <link rel="stylesheet" type="text/css" href="../view/style/style.css">
      </head>

    <body>
        <!--Header --> 
        <?php include(__DIR__.'/header.student.viewpart.php'); ?>

        <main>
            <h1>Rejoindre une classe</h2>
                
            <img class="skin" src="../../skin.png" alt="">
                
            <p><?=$currentClass?></p>
            <label for="code">Entrez le code fourni par votre professeur pour rejoindre votre classe ! :</label>
            <!-- Si le code ne correspond à aucune partie mettre un message d'erreur 
                Sinon rejoindre la partie dans student.lobby.view.php-->
            <form action="../controler/student.join.classgroup.ctrl.php" method= "post" class="joinParty">
              <input type="text" id="code" name="code" required minlength="5" maxlength="5" size="7" style="font-size: 18px"/>
              <div class="button-container">
                <a href="../controler/home.ctrl.php">RETOUR</a>
                <button class="button2" type="submit" >REJOINDRE</button>
              </div>
            </form>
            <div>
              <p><?=$message?></p>
            </div>
        </main>

        <!--Footer --> 
        <?php include(__DIR__.'/footer.viewpart.html'); ?>   
    </body>
</html>