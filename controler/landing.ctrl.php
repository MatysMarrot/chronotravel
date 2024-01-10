<?php
//Inclure le php
include_once(__DIR__."/../framework/view.class.php");

if($_SESSION['login'] == true){
    include("../view/student.lobby.view.php");
} else{
    include("../view/landingpage.php");
}
