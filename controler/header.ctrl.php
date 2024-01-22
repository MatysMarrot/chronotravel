<?php
session_start();

if(!isset($_SESSION['id'])){
    include(__DIR__."/../view/header.unknown.viewpart.php");
}
elseif ($_SESSION['roleid'] == 2){
    include(__DIR__ ."/../view/header.teacher.viewpart.php");
}
elseif($_SESSION['roleid'] == 1){
    include (__DIR__ . "/../view/header.student.viewpart.php");
}

?>