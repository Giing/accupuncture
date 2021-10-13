<?php


$app = new App();

$app->get("home", "SiteController", "index");

$app->get("liste", "SiteController", "listAll");
$app->get("listFiltered", "SiteController", "listFiltered");

$app->get("register","UserController","register");
$app->post("register","UserController","addUser");

$app->get("login","UserController","login");
$app->get("logout","UserController","logout");
$app->post("login","UserController","connect");


$app->get("test", "TestController", "index", true);

$app->get("notFound", "TestController", "index");

