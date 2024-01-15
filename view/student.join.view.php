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
            <h1>Rejoindre une partie</h2>
                
            <img class="skin" src="../../skin.png" alt="">
                
            <h2>Pseudo</h2>
            <form action="../controler/waitroom.ctrl.php">
              <label for="code">Entrez le code de la partie pour la rejoindre:</label>
              <input type="text" id="code" name="code" required minlength="5" maxlength="5" size="7" style="font-size: 18px"/>
              <div class="button-container">
                <button class="button2" type="submit" >RETOUR</button>
                <button class="button2" type="submit" >REJOINDRE</button>
              </div>
              <span><?=$message?></span>
            </form>
        </main>

        <!--Footer --> 
        <?php include(__DIR__.'/footer.viewpart.html'); ?>   
    </body>
</html>