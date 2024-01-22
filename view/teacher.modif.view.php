<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Chrono Travel- Gestion des élèves</title>
    <link rel="stylesheet" type="text/css" href="../view/style/style.css">
</head>

<body>
<?php $currentPage = 'manage';
include(__DIR__.'/header.teacher.viewpart.php'); ?>

<main>
    <h2>Modifier</h2>

    <form class="gestion" action="../controler/teacher.modif.ctrl.php" method = "post">
            <?php if(count($classList) != 0) :?>
                <div>
                    <label>Modifier le nom de la classe:</label>
                    <input value = "<?=$className?>"name = "className"type="text">

                </div>
    </form>

</main>

<!--Footer -->
<?php include(__DIR__.'/footer.viewpart.html'); ?>
</body>
</html>