<?php


$app = new App();

$app->get("home", "SiteController", "index");
$app->get("register","UserController","index");
$app->post("register","UserController","test");



