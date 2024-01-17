<?php $emplacementSkin = "../view/skin/"?>
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
            <div class="div_skin">
                <img id="skin" src="<?=$emplacementSkin?>skintest.png" alt="personnage">
                <?php if($currentSkin[2] != null):?>
                <img id="shirt" src="<?=$emplacementSkin.$currentSkin[2]->getLocation()?>" alt="Tee-shirt">
                <?php endif; ?>
                <?php if($currentSkin[1] != null):?>
                <img id="hair" src="<?=$emplacementSkin.$currentSkin[1]->getLocation()?>" alt="Cheveux">
                <?php endif; ?>
                <?php if($currentSkin[0] != null):?>
                <img id="top" src="<?=$emplacementSkin.$currentSkin[0]->getLocation()?>" alt="Chapeau">
                <?php endif; ?>
                <?php if($currentSkin[3] != null):?>
                <img id="pants" src="<?=$emplacementSkin.$currentSkin[3]->getLocation()?>" alt="Pantalon">
                <?php endif; ?>
                <?php if($currentSkin[4] != null):?>
                <img id="shoes" src="<?=$emplacementSkin.$currentSkin[4]->getLocation()?>" alt="Chaussures">
                <?php endif; ?>
                <!--<h3 id="pseudo">PSEUDO</h3>-->
            </div>
        </section>
        <section>
            <form action="../controler/checkroom.ctrl.php" method="post">
                <?php foreach ($allSkins as $skin) : ?>
                <div>
                    <input type="submit" style="background-image: url('../view/skin/<?=$skin->getLocation()?>');" name="skin" value="<?=$skin->getSkinId()?>">
                </div>
                <?php endforeach; ?>
            </form>
        </section>
    </main>
    <?php include(__DIR__.'/footer.viewpart.html'); ?> 
    </body>
  </html>