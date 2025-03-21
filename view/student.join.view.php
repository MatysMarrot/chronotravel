<!DOCTYPE html>
  <html lang="fr">
    <head>
      <meta charset="UTF-8">
      <title>ChronoTravel - Rejoindre une partie</title>
      <link rel="stylesheet" type="text/css" href="../view/style/style.css">
      </head>

    <body>
        <!--Header -->
        <?php include(__DIR__.'/../controler/header.ctrl.php'); ?>

        <main>
            <h1>Rejoindre une partie</h1>
                
            <img class="skin" src="../../skin.png" alt="">
                
            <h2><?=($_SESSION['login'] ?? "PSEUDO")?></h2>
            <form action="../controler/student.join.ctrl.php" method="post" class="joinParty">
              <label for="code">Entrez le code de la partie pour la rejoindre:</label>
              <input type="text" id="code" name="code" required minlength="5" maxlength="5" size="7" style="font-size: 18px"/>
              <span class="error"><?=$message ?? ""?></span>
              <div class="button-container">
                  <button class="button2" type="button" onclick="window.location.href='../controler/landing.ctrl.php'">RETOUR</button>
                  <button class="button2" type="submit" >REJOINDRE</button>
              </div>
            </form>
        </main>

        <!--Footer --> 
        <?php include(__DIR__ . '/footer.viewpart.html'); ?>
    </body>
</html>