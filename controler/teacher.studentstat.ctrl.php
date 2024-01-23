<?php
include_once(__DIR__."/../framework/view.class.php");
include_once(__DIR__."/../model/Student.class.php");
include_once(__DIR__."/../model/Stat.class.php");
include_once(__DIR__."/../model/StatPerGame.class.php");

$view = new View();
$outgoing = "../view/teacher.statStudent.view.php";

if(!isset($_SESSION["id"])) {
    $outgoing = "../controler/landing.ctrl.php";
}
$view->assign("student", $student);
$allStat = Stat::getStatOf($student->getId());
if ($allStat !=null) {
    $allStatJSON = json_encode($allStat);
    $view->assign("allStatJSON", $allStatJSON);
}
$view->assign("allStat", $allStat);
$view->display("../view/".$outgoing);

?>
