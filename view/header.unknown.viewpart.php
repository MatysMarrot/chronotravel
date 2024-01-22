<head>
    <link rel="stylesheet" type="text/css" href="../view/style/header.unknown.css">
</head>
<header class="connectionpage">
        <a <?= ($currentPage == 'rules') ? 'class="active"' : ''; ?> href="../controler/rules.ctrl.php">Règles</a>
        <a href="../controler/landing.ctrl.php"><h1>Chronotravel</h1></a>
        <a <?= ($currentPage == 'contact') ? 'class="active"' : ''; ?> href="../controler/contact.ctrl.php">Contact</a>
</header>