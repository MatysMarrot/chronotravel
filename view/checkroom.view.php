<!DOCTYPE html>
  <html lang="fr">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>ChronoTravel - Mes Tenues</title>
      <link rel="stylesheet" href="../view/style/style.css">
    </head>
    <body>
    <?php
      $currentPage = 'checkroom';
      include(__DIR__.'/header.student.viewpart.php');
    ?>
    <main class="checkroom"> 
        <section>
            <img src="../view/img/skintest.png" alt="Skin">
        </section>
        <section>
          <div>
            <a href="../controler/checkroom.ctrl.php"><img src="../view/img/skintest.png" alt="Skin"></a>
          </div>
          <div>
            <a href="../controler/checkroom.ctrl.php"><img src="../view/img/skintest.png" alt="Skin"></a>
          </div>
          <div>
            <a href="../controler/checkroom.ctrl.php"><img src="../view/img/skintest.png" alt="Skin"></a>
          </div>
          <div>
            <a href="../controler/checkroom.ctrl.php"><img src="../view/img/skintest.png" alt="Skin"></a>
          </div>    
        </section>
    </main>
    <?php include(__DIR__.'/footer.viewpart.html'); ?> 
    </body>
  </html>