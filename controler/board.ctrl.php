<?php
include ("../view/board.view.php");
session_start();
echo "<div id='session'> " . json_encode($_SESSION) . "</div>";
?>