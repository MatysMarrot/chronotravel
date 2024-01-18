<head>
    <link rel="stylesheet" type="text/css" href="../view/style/header.teacher.css">
</head>
<header class="header_teacher">
        <nav>
            <ul class="ul_horizontal">
                    <li ><a <?= ($currentPage == 'home') ? 'class="active"' : ''; ?> href="../controler/teacher.home.ctrl.php">Accueil</a></li>
                    <li><a <?= ($currentPage == 'manage') ? 'class="active"' : ''; ?> href="../controler/teacher.manage.ctrl.php">Mes Classes</a></li>
                    <li><a <?= ($currentPage == 'contact') ? 'class="active"' : ''; ?> href="../controler/contact.ctrl.php">Contact</a></li>
                    <li><a href="../logout.php">Déconnexion</a></li>
            </ul>
        </nav>
</header>