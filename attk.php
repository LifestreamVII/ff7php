<?php

require "loader.php";

session_start();

$Char1 = $_SESSION['Char1'];
$Char2 = $_SESSION['Char2'];

if ($_POST["idfrom"] == "chr1"){
$atkFrom = $_SESSION['Char1'];
}
else if ($_POST["idfrom"] == "chr2") {
$atkFrom = $_SESSION['Char2'];
}

if ($_POST["idtargt"] == "optchr1"){
    $atkFrom -> attaquer($Char1, $atkFrom -> get_atk());
}
else if ($_POST["idtargt"] == "optchr2"){
    $atkFrom -> attaquer($Char2, $atkFrom -> get_atk());
    var_dump($_SESSION['Char1']);
}


?>