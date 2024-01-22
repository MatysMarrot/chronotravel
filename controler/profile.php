<?php
include_once(__DIR__."/../framework/view.class.php");
include_once(__DIR__."/../model/DAO.class.php");
include_once(__DIR__."/../model/Student.class.php");
include_once(__DIR__."/utils/Utils.php");

$view = new View();
session_start();

$error = "";

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];

    // Récupérer les informations de l'utilisateur depuis la base de données
    $dao = DAO::get();
    $data = [$userId];
    $query = "SELECT login FROM Person WHERE id = ?";
    $table = $dao->query($query, $data);

    if (count($table)) {
        $pseudo = $table[0]['login'];
    } else {
        // Gérer le cas où l'utilisateur n'est pas trouvé
        $pseudo = "Utilisateur inconnu";
    }

    $view->assign("pseudo", $pseudo); // Assurez-vous que cette variable est disponible dans votre vue
} else {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: login.view.php");
    exit();
}

$view->assign("error", $error);
$view->display("profile.php");
?>
