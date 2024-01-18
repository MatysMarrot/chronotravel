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
            <?php if($buyView): ?>
                <img src="<?=$emplacementSkin.$skin->getLocation()?>">
                <p>Souhaitez-vous achetez ce cosmétique pour <?=$skin->getPrice()?> Chronocoins ?</p>
                <p>Vous possédez XXX Chronocoins.</p>
                <form>
                    <div>
                        <label>Quitter</label>
                        <input type="submit" name="action" value="leave">
                    </div>
                    <div>
                        <label>Acheter</label>
                        <input type="submit" name="action" value="buy">
                    </div>
                </form>
            <?php else: ?>
                <form action="../controler/checkroom.ctrl.php" method="post" class="chooseSkin">
                    <?php foreach ($possessedSkin as $skin) : ?>
                        <div class="unlockedSkin">
                            <input type="submit" style="background-image: url('../view/skin/<?=$skin->getLocation()?>');" name="skin" value="<?=$skin->getSkinId()?>">
                        </div>
                    <?php endforeach; ?>
                    <?php foreach ($unpossessedSkin as $skin) : ?>
                        <div class="lockedSkin">
                            <input type="submit" style="background-image: url('../view/skin/<?=$skin->getLocation()?>');" name="skin" value="<?=$skin->getSkinId()?>">
                            <div class="price">
                                <span><?=$skin->getPrice()?></span>
                                <img src="../view/img/chrono_coin.png" alt="Chronocoin">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </form>
            <?php endif; ?>
        </section>
    </main>
    <?php include(__DIR__.'/footer.viewpart.html'); ?> 
    </body>
  </html>