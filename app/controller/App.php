<?php

class App {

	private ViewController $viewController;

	public function __construct() {
		$this->viewController = new ViewController();
	}

	public function route($route, $controller, $action, $method="GET", $api=false) {
		if($_SERVER["REQUEST_METHOD"] === $method) {
			if (isset($_GET["route"]) && $_GET["route"] == $route) {
				$this->viewController->render((new $controller())->$action(), $api && array_key_exists("api", $_GET));
			}
		}
	}
	public function get($route, $controller, $action, $api=false){
		$this->route($route, $controller, $action, "GET", $api);
	}
	public function post($route, $controller, $action, $api=false){
		$this->route($route, $controller, $action, "POST", $api);
	}
}