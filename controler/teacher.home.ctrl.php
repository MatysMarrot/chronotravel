<?php

if(!isset($_SESSION['id']) || $_SESSION['roleid'] != 2){
    include(__DIR__ . "/../controler/landing.ctrl.php");
}
else{
    include(__DIR__ . "/../view/teacher.home.view.php");
}

?>