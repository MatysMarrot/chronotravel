<head>
    <link rel="stylesheet" type="text/css" href="../view/style/header.teacher.css">
</head>
<a href="../controler/landing.ctrl.php"><img id="logo" src="../view/img/logo.png" alt="ChronoTravel_logo"></a>
<header class="header_teacher">

        <nav>
            <ul class="ul_horizontal">
                    <li ><a <?= ($currentPage == 'home') ? 'class="active"' : ''; ?> href="#">Accueil</a></li>
                    <li><a <?= ($currentPage == 'profil') ? 'class="active"' : ''; ?> href="#">Mon Profil</a></li>
                    <li><a <?= ($currentPage == 'faq') ? 'class="active"' : ''; ?> href="#">FAQ</a></li>
                    <li><a <?= ($currentPage == 'contact') ? 'class="active"' : ''; ?> href="#">Conctact</a></li>
            </ul>
        </nav>
</header>