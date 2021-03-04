<?php

require "loader.php";

header("Content-Type: text/plain");

$matFire = new Materia(70, 0, "atk", "Fire", "green");
$matRestore = new Materia(0, 50, "heal", "Restore", "green");
$sephiroth = $manager -> get("Sephiroth");

// $manager -> add(new SOLDIER(999, 220, 60, "Zack"));

echo ($sephiroth -> get_name() ." attaque de " .$sephiroth -> get_atk() ." et a actuellement " .$sephiroth -> get_pv() ." PV");



?>