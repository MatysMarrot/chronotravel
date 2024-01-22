<?php

require_once(__DIR__."/../model/Student.class.php");

session_start();

if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];
    $student = Student::readStudent($userId);
    $currencyAmount = $student->getCurrency();
    if(isset($_POST['isDys'])) {
        $isDys = $_POST['isDys'] ?? 0;
        $_SESSION["isDys"] = $isDys;
    } else {
        $isDys = $_SESSION["isDys"] ?? 0;
    }
    //var_dump($isDys);
} else {
    header("Location: login.view.php");
    exit();
}

?>


<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<a href="../controler/landing.ctrl.php"><img id="logo" src="../view/img/logo.png" alt="ChronoTravel_logo"></a>
<header id="student_header">
    <nav>
        <ul>
            <li <?= ($currentPage == 'home') ? 'class="active"' : ''; ?>>
                <a href="../controler/home.ctrl.php"> <i class="material-symbols-outlined">Home</i></a>
                <span class="tooltip_text">ACCUEIL</span>
            </li>
            <li <?= ($currentPage == 'profile') ? 'class="active"' : ''; ?>>
                <a href="../controler/profile.ctrl.php"><i class="material-symbols-outlined">Person</i></a>
                <span class="tooltip_text">MON PROFIL</span>
            </li>
            <li <?= ($currentPage == 'checkroom') ? 'class="active"' : ''; ?>>
                <a href="../controler/checkroom.ctrl.php"> <i class="material-symbols-outlined">Checkroom</i></a>
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

    <form id="dyslexie-div" action="../controler/<?= $currentPage ?>.ctrl.php" method="post">
        <input type="hidden" name="isDys" value="<?= $isDys==0 ? 1 : 0 ?>">
        <button id="fontToggleBtn" type="submit">Mode dys.</button>
        <div class="dys" style="display: none;"><?= $isDys ?></div>
    </form>

</header>

<script src="../view/js/dyslexieFont.js"></script>