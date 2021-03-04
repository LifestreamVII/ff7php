<?php

require "loader.php";

$chArr = $manager -> list();
print json_encode($chArr);

?>