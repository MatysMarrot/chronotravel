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

<aside id="home_button">
    <ul>
        <li id="join_class_button"><a href="../controler/teacher.manage.ctrl.php">Gestion de vos classes</a></li>
    </ul>
</aside>

</body>
</html>
