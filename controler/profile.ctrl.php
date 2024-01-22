<?php
include_once(__DIR__."/../framework/view.class.php");
include_once(__DIR__."/../model/DAO.class.php");
include_once(__DIR__."/../model/Student.class.php");
include_once(__DIR__."/utils/Utils.php");
include_once(__DIR__."/../model/SkinObject.class.php");

$view = new View();
session_start();

$error = "";

if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];

    $dao = DAO::get();
    $data = [$userId];
    $queryUser = "SELECT id, login FROM Person WHERE id = ?";
    $resultUser = $dao->query($queryUser, $data);

    if (count($resultUser) > 0) {
        $pseudo = $resultUser[0]['login'];
        $userId = $resultUser[0]['id'];

        $view->assign("pseudo", $pseudo);
        $view->assign("userId", $userId);

        $queryClass = "SELECT classid FROM studentclass WHERE studentid = ?";
        $resultClass = $dao->query($queryClass, [$userId]);

        if (count($resultClass) > 0) {
            $classId = $resultClass[0]['classid'];

            $queryClassName = "SELECT name FROM Class WHERE id = ?";
            $resultClassName = $dao->query($queryClassName, [$classId]);

            if (count($resultClassName) > 0) {
                $className = $resultClassName[0]['name'];

                $profQuery = "SELECT Person.name FROM Person
                              JOIN ClassTeacher ON Person.id = ClassTeacher.teacherId
                              WHERE ClassTeacher.classId = ?";
                $profResult = $dao->query($profQuery, [$classId]);

                if (count($profResult) > 0) {
                    $profName = $profResult[0]['name'];
                    $view->assign("profName", $profName);
                } else {
                    $error = "Nom du professeur non trouvé pour la classe";
                }
                $view->assign("className", $className);
            } else {
                $error = "Nom de la classe non trouvé pour l'étudiant";
            }
        } else {
            $error = "Classe non trouvée pour l'étudiant";
        }
    } else {
        $pseudo = "Utilisateur inconnu";
    }
} else {
    header("Location: login.view.php");
    exit();
}


function getCurrentSkinOfPlayer(int $playerId) : array {
    $dao = DAO::get();
    $query = "SELECT hat, hair, teeshirt, pants, shoes FROM currentskin WHERE playerid=?";
    $table = $dao->query($query, [$playerId]);
    $currentSkin = [];
    if(!count($table)) {
        $dao->exec("INSERT INTO currentskin VALUES ($playerId, null, null, null, null, null, '000000')");
        $currentSkin = [null, null, null, null, null];
    } else {
        $row = $table[0];
        for($i=0; $i < 5; $i++) {
            if($row[$i] != null) {
                $query = "SELECT skinid, skinobject.name as name, price, location, skinpart.name as partname FROM skinobject JOIN skinpart ON skinobject.parts=skinpart.skinpartid WHERE skinid=?";
                $table = $dao->query($query, [$row[$i]]);
                $rowSkinObject = $table[0];
                $newSkin = new SkinObject($rowSkinObject["skinid"], $rowSkinObject["name"], $rowSkinObject["price"], $rowSkinObject["location"], $rowSkinObject["partname"]);
                $currentSkin[] = $newSkin;
            } else {
                $currentSkin[] = null;
            }
        }
    }
    return $currentSkin;
}


$currentSkin = getCurrentSkinOfPlayer($userId);
$view->assign("currentSkin", $currentSkin);

$view->assign("error", $error);
$view->display("profile.ctrl.php");
?>
