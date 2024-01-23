<?php
include_once(__DIR__."/../framework/view.class.php");
include_once(__DIR__."/../model/DAO.class.php");
include_once(__DIR__."/../model/Student.class.php");
include_once(__DIR__."/../model/Stat.class.php");
include_once(__DIR__."/../model/StatPerGame.class.php");
include_once(__DIR__."/../model/SkinObject.class.php");
include_once(__DIR__."/utils/Utils.php");

$view = new View();
session_start();
$error = "";
// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];
    // Récupère les informations de l'utilisateur depuis la base de données
    $student = Student::readStudent($userId);
    $currentSkin = SkinObject::getCurrentSkinOfPlayer($userId);
    $allStat = Stat::getStatOf($userId);
    if ($allStat !=null) {
        $allStatJSON = json_encode($allStat);
        $view->assign("allStateJSON", $allStatJSON);
    }
    try {
        $classAndTeacher = $student->getClassAndTeacherName();
        $view->assign("classAndTeacher", $classAndTeacher);
    } catch (Exception $e) {
        $view->assign("classError", "Vous n'avez pas rejoint de classe");
    }
    $view->assign("currentSkin", $currentSkin);
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
