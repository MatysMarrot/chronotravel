<?php
include_once(__DIR__ . '/../controler/utils/Utils.php');

$blaz = "chemine";
$pass = "pass";
$data = array("login" => $blaz, "password" => $pass);

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
?>