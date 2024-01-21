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
include(__DIR__.'/header.student.viewpart.php');
?>

<main id="home_button">
    <p>Suivez de près les statistiques des parties de jeu de vos élèves!</p>
    <ul>
        <li id="home_button"><a href="../controler/teacher.manage.ctrl.php">Gestion de vos classes</a></li>
    </ul>
</main>

</body>
</html>
