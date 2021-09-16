<?php


$app = new App();

$app->route("home", "SiteController", "index");
$app->route("beers", "BeerController", "liste");
$app->route("random", "BeerController", "random");
$app->route("onebeer", "BeerController", "oneBeer");
$app->route("add", "BeerController", "addBeer");
$app->route("delete", "BeerController", "delete");



