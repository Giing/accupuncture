<?php
// Fichier qui gère la connexion à la base de données

spl_autoload_register(function ($class) {
	if (strpos($class, "Controller") !== false || $class == 'App')
		include_once "controller/".$class.".php";
    else
		include_once "model/".$class.".php";
});

$user = 'postgres-web';
$pass = 'web';
$host = "localhost";
$db = "acudb";
$db = new PDO("pgsql:host=$host; dbname=$db", $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$db->query("SET search_path TO acudb;");

function db() { global $db; return $db; }








