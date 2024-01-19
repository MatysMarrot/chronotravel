<?php
include_once(__DIR__."/../model/DAO.class.php");
include_once(__DIR__."/../model/Student.class.php");
include_once(__DIR__."/../model/Party.class.php");

$party = Party::getPartyFromId(2);
var_dump($party);

?>