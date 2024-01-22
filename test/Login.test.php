<?php 
include_once(__DIR__."/../model/DAO.class.php");
include_once(__DIR__."/../model/Student.class.php");
include_once(__DIR__."/../model/enum/era.enum.php");


echo password_verify("Motdepasse1", password_hash("Motdepasse1", PASSWORD_BCRYPT)) ? "True" : "False";

echo EraUtil::getOrdinal(Era::ANTIQUITY);