<?php
include_once(__DIR__ . '/../controler/utils/Utils.php');

echo time();
session_start();

$blaz = "chemine";
$pass = "pass";
$data = array("login" => $blaz, "password" => $pass);

var_dump($data);
var_dump(log_session($data));

var_dump($_SESSION);

?>