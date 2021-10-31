<?php


$app = new App();

$app->get("home", "SiteController", "index");

//
$app->get("liste", "SiteController", "listAll");
$app->get("listFiltered", "SiteController", "listFiltered");


// List, Filter symptomes by main pathologies (Quetion 1.2.1)
$app->get("listSymptomes", "SiteController", "listAllMainPathologies");
$app->get("listFilteredSymptomes", "SiteController", "listSymptomesByMainPathologies");

$app->get("search", "SiteController", "search");

$app->get("register","UserController","register");
$app->post("register","UserController","addUser");

$app->get("login","UserController","login");
$app->get("logout","UserController","logout");
$app->post("login","UserController","connect");


$app->get("test", "TestController", "index", true);

$app->get("notFound", "TestController", "index");

