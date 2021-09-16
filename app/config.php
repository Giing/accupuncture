<?php
spl_autoload_register(function ($class) {
	if (strpos($class, "Controller") !== false || $class == 'App')
		include_once "controller/".$class.".php";
    else
		include_once "model/".$class.".php";
});

$user = 'root';
$pass = '';
$db = new PDO("mysql:host=localhost; dbname=beers", $user, $pass);
//$db->query("SET search_path TO beers;");

function db() { global $db; return $db; }








