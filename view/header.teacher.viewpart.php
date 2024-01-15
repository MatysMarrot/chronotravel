<head>
    <link rel="stylesheet" type="text/css" href="../view/style/header.teacher.css">
</head>
<header class="header_teacher">
        <nav>
            <ul class="ul_horizontal">
                    <li ><a <?= ($currentPage == 'home') ? 'class="active"' : ''; ?> href="#">ACCUEIL</a></li>
                    <li><a <?= ($currentPage == 'profil') ? 'class="active"' : ''; ?> href="#">MON PROFIL</a></li>
                    <li><a <?= ($currentPage == 'faq') ? 'class="active"' : ''; ?> href="#">FAQ</a></li>
                    <li><a <?= ($currentPage == 'contact') ? 'class="active"' : ''; ?> href="#">CONTACT</a></li>
            </ul>
        </nav>
</header>