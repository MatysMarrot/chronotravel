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
                <img id="skincolor" src="<?=$emplacementSkin.$currentSkin[5]->getLocation()?>" alt="personnage">
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
             <form class="skinColor-form" action="../controler/checkroom.ctrl.php" method="post">

                    <?php foreach ($colorSkin as $color) : ?>
                            <button id="skinChoose" type="submit" name="skinColor" value="<?=$color->getSkinId()?>"></button>
                    <?php endforeach; ?>
             </form>
        </section>
        <?php if($buyView): ?>
        <section class="buyView">
            <h3><?=$selectedSkin->getFrenchSkinPart()?> : <?=$selectedSkin->getName()?></h3>
            <img src="<?=$emplacementSkin.$selectedSkin->getLocation()?>" class="preview">
            <span>Souhaitez-vous acheter ce cosmétique pour <em><?=$selectedSkin->getPrice()?></em> <img src="../view/img/chrono_coin.png" alt="Chronocoin">?</span>
            <span>Vous possédez <em><?=$student->getCurrency()?></em><img src="../view/img/chrono_coin.png" alt="Chronocoin">.</span>
            <form action="../controler/checkroom.ctrl.php" method="post" class="button-container">
                <button type="submit" name="leave" value="<?=$selectedSkin->getSkinId()?>">ANNULER</button>
                <button type="submit" name="buy" value="<?=$selectedSkin->getSkinId()?>" <?= $student->getCurrency()<$selectedSkin->getPrice() ? "disabled" : "" ?>>ACHETER</button>
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