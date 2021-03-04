<?php

require "loader.php";

session_start();

echo ($_SESSION['Char1'] -> get_pv(). ", ".$_SESSION['Char2'] -> get_pv());

?>