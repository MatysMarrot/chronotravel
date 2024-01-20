<?php
include_once(__DIR__ . "/../controler/utils/Utils.php");
include_once(__DIR__ . "/../model/DAO.class.php");
include_once(__DIR__ . "/../model/Student.class.php");
include_once(__DIR__ . "/../model/Party.class.php");
include_once(__DIR__ . "/../framework/view.class.php");

$view = new View();

session_start();
if(!isset($_SESSION['id']) || $_SESSION['roleid'] != 1){
    $view->display("../controler/landing.ctrl.php");
}

else{
    $dao = DAO::get();
    $data = [$_SESSION['id']];
    $query = "SELECT creatorid FROM party WHERE creatorid = ? AND partystate = 1";
    $table = $dao->query($query,$data);

    if(count($table) == 0){
        $party = new Party($_SESSION['id']);
        $party->create();
    }
    $view->display("../controler/student.lobby.ctrl.php");

    foreach ($table as $ligne){
        if (isset($ligne['id'])){
            $partyid = $ligne['id'];

            $query = "DELETE FROM PartyCode WHERE partyId = ?";
            $dao->exec($query, [$partyid]);

            $query = "DELETE FROM PartyStudent WHERE partyId = ?";
            $dao->exec($query, [$partyid]);

            $query = "DELETE FROM Party WHERE id = ?";
            $dao->exec($query, [$partyid]);

            var_dump($partyid);
        }
    }




    $party = new Party($_SESSION['id']);
    $party->create();
    $view->display("../controler/student.lobby.ctrl.php");
}




?>