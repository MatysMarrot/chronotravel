<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" type="text/css" href="../view/style/header.student.css">
</head>
<header>
    <nav>
        <ul>
            <li <?= ($currentPage == 'home') ? 'class="active"' : ''; ?>>
                <a href="home.php"> <i class="material-symbols-outlined">Home</i></a>
                <span class="tooltip_text">ACCUEIL</span>
            </li>
            <li <?= ($currentPage == 'profile') ? 'class="active"' : ''; ?>>
                <a href="profile.php"><i class="material-symbols-outlined">Person</i></a>
                <span class="tooltip_text">MON PROFIL</span>
            </li>
            <li <?= ($currentPage == 'outfit') ? 'class="active"' : ''; ?>>
                <a href="outfit.php"> <i class="material-symbols-outlined">Checkroom</i></a>
                <span class="tooltip_text">MES TENUES</span>
            </li>
            <li <?= ($currentPage == 'logout') ? 'class="active"' : ''; ?>>
                <a href="logout.php"> <i class="material-symbols-outlined">Logout</i></a>
                <span class="tooltip_text">DÉCONNEXION</span>
            </li>
        </ul>
    </nav>
    <div id="number_chronocoin">
        <img src="img/chrono_coin.png" alt="ChronoCoins">
        <span>12345</span>
    </div>
</header>