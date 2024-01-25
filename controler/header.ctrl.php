<?php
session_start();

if(!isset($_SESSION['id'])){
    include(__DIR__."/../view/header.unknown.viewpart.php");
}
elseif ($_SESSION['roleid'] == 2){
    include(__DIR__ ."/../view/header.teacher.viewpart.php");
}
elseif($_SESSION['roleid'] == 1){
    require_once(__DIR__."/../model/Student.class.php");

    if (isset($_SESSION['id'])) {
        $userId = $_SESSION['id'];
        $student = Student::readStudent($userId);
        $currencyAmount = $student->getCurrency();

        if(isset($_POST['isDys'])) {
            $isDys = $_POST['isDys'] ?? 0;
            $_SESSION["isDys"] = $isDys;
        } else {
            $isDys = $_SESSION["isDys"] ?? 0;
        }
        //var_dump($isDys);
    } else {
        header("Location: login.view.php");
        exit();
    }

    include (__DIR__ . "/../view/header.student.viewpart.php");
}

?>