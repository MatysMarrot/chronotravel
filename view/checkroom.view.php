<?php $emplacementSkin = "/assets/skin/"?>
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
            <?php if($buyView): ?>
            <h3>Prévisualisation</h3>
            <?php endif; ?>
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
        <?php if($buyView): ?>
        <section class="buyView">
            <h3><?=$selectedSkin->getFrenchSkinPart()?> : <?=$selectedSkin->getName()?></h3>
            <img src="<?=$emplacementSkin.$selectedSkin->getLocation()?>">
            <div>
                <span>Souhaitez-vous acheter ce cosmétique pour <em><?=$selectedSkin->getPrice()?></em></span>
                <img src="../view/img/chrono_coin.png" alt="Chronocoin">
                <span> ?</span>
            </div>
            <div>
                <span>Vous possédez <em><?=$student->getCurrency()?></em></span>
                <img src="../view/img/chrono_coin.png" alt="Chronocoin">
                <span>.</span>
            </div>
            <form action="../controler/checkroom.ctrl.php" method="post" class="button-container">
                <button type="submit" name="leave" value="<?=$selectedSkin->getSkinId()?>">ANNULER</button>
                <button type="submit" name="buy" value="<?=$selectedSkin->getSkinId()?>">ACHETER</button>
            </form>
        </section>
        <?php else: ?>
        <section class="chooseSkin">
            <form action="../controler/checkroom.ctrl.php" method="post">
                <?php foreach ($possessedSkin as $skin) : ?>
                    <div class="unlockedSkin">
                        <button type="submit" name="skin" value="<?=$skin->getSkinId()?>""><img src="<?=$emplacementSkin.$skin->getLocation()?>"></button>
                    </div>
                <?php endforeach; ?>
                <?php foreach ($unpossessedSkin as $skin) : ?>
                    <div class="lockedSkin">
                        <button type="submit" name="skin" value="<?=$skin->getSkinId()?>""><img src="<?=$emplacementSkin.$skin->getLocation()?>"></button>
                        <div class="price">
                            <span><?=$skin->getPrice()?></span>
                            <img src="../view/img/chrono_coin.png" alt="Chronocoin">
                        </div>
                    </div>
                <?php endforeach; ?>
            </form>
        </section>
        <?php endif; ?>
    </main>
    <?php include(__DIR__.'/footer.viewpart.html'); ?> 
    </body>
  </html>