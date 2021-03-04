<?php

require "loader.php";

session_start();

$query = $db -> prepare('SELECT * FROM `materias_owned` WHERE `char_id` = :charId');
$query -> execute([':charId' => $_POST["charId"]]);
$data = $query -> fetchAll();

foreach ($data as &$value) {
    $value = $value["mat_id"];
    $comma_string[] = $value;
}

echo (implode(", ", $comma_string));

$arrayLength = count($comma_string);

    foreach($comma_string as $key => $value){
        $i = 0;
        $_POST["mat".$i] = $manager -> getMateria(intval($comma_string[$i]));
        $i++;
        }
        echo $mat0 -> get_name();

?>