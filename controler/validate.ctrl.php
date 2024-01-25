<?php
    include_once(__DIR__."/../model/Student.class.php");

    $id=$_GET['id'];

    $dao = DAO::get();
    $query = "UPDATE person SET validate = true WHERE id=?";
    $dao->exec($query,[$id]);