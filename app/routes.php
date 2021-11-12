<?php

// Web application entry point
$app = new App();

// home page
$app->get("home", "SiteController", "index");

// List pathologies,symptoms, keywords (Requirements: 1.2.1)
$app->get("liste", "SiteController", "listAll");

// List, Filter pathologies with main pathologies and characteristics (Requirements: 1.2.2)
$app->get("listMainPathologies", "SiteController", "listAllMainPathologies");
$app->get("listFilteredPathologies", "SiteController", "listPathologiesByMainPathologies");

// List, Filter pathologies with keywords searchengine (Requirements: 1.2.3)
$app->get("search", "SiteController", "search", true);

// User management (Requirements: { 2 states => "logged in", "logged out" }, { no roles })
// Register
$app->get("register","UserController","register");
$app->post("register","UserController","addUser");

// Log
$app->get("login","UserController","login");
$app->get("logout","UserController","logout");
$app->post("login","UserController","connect");

// 404
$app->get("notFound", "SiteController", "index");