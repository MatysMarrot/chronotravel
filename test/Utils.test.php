<?php
include_once(__DIR__ . '/../controler/utils/Utils.php');
include_once(__DIR__ . '/../model/DAO.class.php');
/*
$blaz = "chemine";
$pass = "pass";
*/
/*$roleid = "0";
$id = "5";
$data = array("login" => $blaz, "password" => $pass, "roleid" => $roleid, "id" => $id);
*/
/*
$query = "SELECT roleid, id,password FROM Person WHERE login = ?";
$dao = DAO::get();

$tableau = $dao->query($query, array("eleve"));
$data = array();
var_dump($tableau);

$roleid = $tableau[0]['roleid'];
$id = $tableau[0]['id'];
log_session(array("id" => $id,"login" => $blaz, "password" => $pass, "roleid" => $roleid ));

var_dump($data);
var_dump(log_session($data));

var_dump($_SESSION);



echo (isMailUniversitaire("mail@ac-grenoble.fr") ? "true" : "false") ."\n";
echo (isMailUniversitaire("mail@felix.ac-grenoble.fr") ? "true" : "false")."\n";
echo (isMailUniversitaire("mail@meriche-mazine.fr") ? "true" : "false") ."\n";
echo (isMailUniversitaire("mail\@meriche-mazine.fr") ? "true" : "false") ."\n";
echo (isMailUniversitaire("mail@.fr") ? "true" : "false") ."\n";
echo (isMailUniversitaire("mail@ac-paris.fr") ? "true" : "false") ."\n";
echo (isMailUniversitaire("mail@ac-wallis-futuna.fr") ? "true" : "false") ."\n";
*/

//$randomCode = generateRandomPartyCode(5);
//echo $randomCode;

?>