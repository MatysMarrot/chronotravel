<!DOCTYPE html>
  <html lang="fr">
    <head>
      <meta charset="UTF-8">
      <title>ChronoTravel - Rejoindre une classe</title>
      <link rel="stylesheet" type="text/css" href="../view/style/style.css">
      </head>

    <body>
        <!--Header -->
        <?php include(__DIR__.'/../controler/header.ctrl.php'); ?>

        <main>
            <h1>Rejoindre une classe</h1>
                
            <img class="skin" src="../../skin.png" alt="">
                
                <p><?=$currentClass?></p>
            <label for="code">Entrez le code fourni par votre professeur pour rejoindre votre classe ! :</label>
            <!-- Si le code ne correspond à aucune partie mettre un message d'erreur 
                Sinon rejoindre la partie dans student.lobby.view.php-->
            <form action="../controler/student.join.classgroup.ctrl.php" method= "post" class="joinParty">
              <input type="text" id="code"  name="code" required minlength="5" maxlength="5" size="7" style="font-size: 18px"/>
                <div class="button-container">
                    <button class="button2" type="button" onclick="window.location.href='../controler/landing.ctrl.php'">RETOUR</button>
                    <button class="button2" type="submit" >REJOINDRE</button>
                </div>
            </form>

            <div>
              <?=$message?>
            </div>
        </main>

        <!--Footer --> 
        <?php include(__DIR__ . '/footer.viewpart.html'); ?>
    </body>
</html>