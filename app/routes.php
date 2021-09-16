<?php


$app = new App();

$app->get("home", "SiteController", "index");
$app->get("register","UserController","register");
$app->post("register","UserController","addUser");
$app->get("login","UserController","login");
$app->post("login","UserController","connect");



