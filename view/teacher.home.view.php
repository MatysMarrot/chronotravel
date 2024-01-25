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
include(__DIR__.'/header.teacher.viewpart.php');
?>

<main id="home_button">
    <p>Suivez de près les statistiques de jeu de vos élèves!</p>
    <ul>
        <li ><a class="button-home" href="../controler/teacher.manage.ctrl.php">Gestion de vos classes</a></li>
        <li ><a class="button-home" href="../controler/teacher.create.ctrl.php">Créer une classe</a></li>
    </ul>
    <p>Pour plus d'informations <a href="../controler/rules.ctrl.php">Cliquez ici !</a></p>
</main>
<?php include(__DIR__ . '/footer.viewpart.html'); ?>
</body>
</html>
