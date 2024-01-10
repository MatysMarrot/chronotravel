<?php
//Inclure le php
include_once(__DIR__."/../framework/view.class.php");

if($_SESSION['login'] == null){
    include("../view/landingpage.php");
    
} else{
    include("../view/student.lobby.view.php");
}
