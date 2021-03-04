<?php

function loadClass($classname)
{
  require "class/$classname.php";
}

spl_autoload_register('loadClass');

$db = new PDO('mysql:host=localhost;dbname=ff7php', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

$manager = new S_Manager($db);

?>