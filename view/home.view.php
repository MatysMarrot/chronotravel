<?php $emplacementSkin = "/assets/skin/"?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChronoTravel - Accueil</title>
    <link rel="stylesheet" href="../view/style/style.css">
</head>

<body>

<?php
$currentPage = 'home';
include(__DIR__.'/../controler/header.ctrl.php');
?>

<main id="home">
    <h1>ChronoTravel</h1>
    <p>Embarquez pour un voyage dans le temps avec notre jeu de plateau multijoueur. Relevez des défis éducatifs
        et explorez les époques. Prêt à devenir le maître de l'histoire?</p>
    <section>
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
        </div>
        <ul class="menu-home">
            <li ><a class="button-home" href="../controler/create.lobby.ctrl.php">Créer une partie</a></li>
            <li ><a class="button-home" href="../controler/student.join.ctrl.php">Rejoindre une partie</a></li>
            <li ><a class="button-home" href="../controler/student.join.classgroup.ctrl.php">Rejoindre une classe</a></li>
        </ul>
    </section>
    <p>Vous ne savez pas comment jouer ? <a href="../controler/rules.ctrl.php">Cliquez ici !</a></p>

</main>
<?php include(__DIR__ . '/footer.viewpart.html'); ?>

</body>
</html>