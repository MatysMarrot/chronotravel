<?php
include_once(__DIR__."/../framework/view.class.php");
include_once(__DIR__."/../model/DAO.class.php");
include_once(__DIR__."/../model/Student.class.php");
include_once(__DIR__."/../model/Stat.class.php");
include_once(__DIR__."/../model/StatPerGame.class.php");
include_once(__DIR__."/utils/Utils.php");

$view = new View();
session_start();

$error = "";

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];
    // Récupère les informations de l'utilisateur depuis la base de données
    $student = Student::readStudent($userId);
    $allStat = Stat::getStatOf($userId);
    $allStatJSON = json_encode($allStat);
    $view->assign("allStateJSON", $allStatJSON);
    $view->assign("allState", $allStat);
    $view->assign("student", $student);
} else {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: login.view.php");
    exit();
}

$view->assign("error", $error);
$view->display("profile.view.php");
?>
