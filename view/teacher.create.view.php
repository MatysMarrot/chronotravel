<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Chrono Travel- Modifier une classe</title>
    <link rel="stylesheet" type="text/css" href="../view/style/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" /></head>

<body>
<?php $currentPage = 'manage';
include(__DIR__.'/header.teacher.viewpart.php'); ?>

<main>
    <div class="container-titre">
        <a href="../controler/teacher.home.ctrl.php"><i class="material-symbols-outlined">arrow_back</i></a>
        <h2>Créer un groupe de classe</h2>
    </div>

    <form class="gestion" action="../controler/teacher.create.ctrl.php" method = "post">
        <div>
            <label>Saisir le nom de la classe:</label>
            <input value="<?=$className?>" name = "newClassName" type="text">
            <button class="button-create" name = "createClass" value = "Créer un nouveau groupe de classe" type = "submit">Créer</button>
        </div>
        <?=$message?>
    </form>

</main>

<!--Footer -->
<?php include(__DIR__.'/footer.viewpart.html'); ?>
</body>
</html>