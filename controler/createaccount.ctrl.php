<?php

include_once(__DIR__."/../framework/view.class.php");
include_once(__DIR__."/../model/DAO.class.php");
include_once(__DIR__."/../model/Student.class.php");
include_once(__DIR__."/../model/Teacher.class.php");
include_once(__DIR__."/utils/Utils.php");

$view = new View();


if(count($_POST) == 0){
    $loginError = "";
    $view->assign("loginError",$loginError);
    $view->display("createaccount.php");
}else{

    $login = $_POST['login'];
    $mail = $_POST['mail'];

    // Recherche du mail et login dans la BD

    $dao = DAO::get();
    $data = [$login];
    $query = "SELECT login FROM Person WHERE login = ?";
    $table1 = $dao->query($query,$data);

    // TODO AJOUTER LES MAILS DANS LA BD /!\/!\/!\/!\/!\/!\

    /*
    $query = "SELECT mail FROM Person WHERE mail = ?";
    $data = [$mail];
    $table2 = $dao->query($query,$data);
    */

    if(count($table1) == 0){
        // Il n'ya pas le mail et le login dans la BD, on peut enregistrer le compte
        $newAccount = null;
        if (isMailUniversitaire($mail)){
            $newAccount = new Teacher($_POST['lastname'],$_POST['firstName'],$login,password_hash($_POST['password'], PASSWORD_BCRYPT));
        } else $newAccount = new Student($_POST['lastname'],$_POST['firstName'],$login,password_hash($_POST['password'], PASSWORD_BCRYPT));
        
    
        $newAccount->create();
        $view->display("login.php");
    
    }
    else{
        $loginError = "Un compte avec le login $login existe déjà !";
        $mailError = "Un compte avec le mail $mail existe déjà ! ";
        $view->assign("loginError",$loginError);
        //$view->assign("mailError",$mailError);
        $view->display("createaccount.php");
    }

}




?>