<?php 
include_once(__DIR__."/../model/DAO.class.php");
include_once(__DIR__."/../model/Student.class.php");

echo password_verify("Motdepasse1", password_hash("Motdepasse1", PASSWORD_BCRYPT)) ? "True" : "False";

