<?php
class App {
	public function route($route, $controller, $action, $method="GET") {
		if($_SERVER["REQUEST_METHOD"] === $method) {
			if (isset($_GET["route"]) && $_GET["route"] == $route)
				(new $controller())->$action();
		}
	}
	public function get($route, $controller, $action){
		$this->route($route, $controller, $action, "GET");
	}
	public function post($route, $controller, $action){
		$this->route($route, $controller, $action, "POST");
	}
}
