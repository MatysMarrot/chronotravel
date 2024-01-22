<?php
    session_start();

    if (isset($_SESSION['id'])) {
        $userId = $_SESSION['id'];

       
        require_once(__DIR__."/../model/DAO.class.php");

        $dao = DAO::get();
        $data = [$userId];
        $query = "SELECT currency FROM Person WHERE id = ?";
        $result = $dao->query($query, $data);

   
        if ($result !== false && count($result) > 0) {
            $currencyAmount = $result[0]['currency'];
            
        } else {
           
            echo "Erreur lors de la récupération du montant de la monnaie.";
        }
    } else {
    
        header("Location: login.view.php");
        exit();
    }
?>


<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" type="text/css" href="../view/style/header.student.css">
</head>
<header>
    <nav>
        <ul>
            <li <?= ($currentPage == 'home') ? 'class="active"' : ''; ?>>
                <a href="../controler/home.ctrl.php"> <i class="material-symbols-outlined">Home</i></a>
                <span class="tooltip_text">ACCUEIL</span>
            </li>
            <li <?= ($currentPage == 'profile') ? 'class="active"' : ''; ?>>
                <a href="../controler/contact.ctrl.php"><i class="material-symbols-outlined">Person</i></a>
                <span class="tooltip_text">MON PROFIL</span>
            </li>
            <li <?= ($currentPage == 'outfit') ? 'class="active"' : ''; ?>>
                <a href="outfit.php"> <i class="material-symbols-outlined">Checkroom</i></a>
                <span class="tooltip_text">MES TENUES</span>
            </li>
            <li <?= ($currentPage == 'rules') ? 'class="active"' : ''; ?>>
                <a href="../controler/rules.ctrl.php"> <i class="material-symbols-outlined">Description</i></a>
                <span class="tooltip_text">RÈGLES</span>
            </li>
            <li <?= ($currentPage == 'contact') ? 'class="active"' : ''; ?>>
                <a href="../controler/contact.ctrl.php"> <i class="material-symbols-outlined">Mail</i></a>
                <span class="tooltip_text">CONTACT</span>
            </li>
            <li <?= ($currentPage == 'logout') ? 'class="active"' : ''; ?>>
                <a href="../logout.php"> <i class="material-symbols-outlined">Logout</i></a>
                <span class="tooltip_text">DÉCONNEXION</span>
            </li>
        </ul>
    </nav>
    <div id="number_chronocoin">
        <img src="../view/img/chrono_coin.png" alt="ChronoCoins">
        <span><?php echo $currencyAmount; ?></span>
    </div>
</header>
