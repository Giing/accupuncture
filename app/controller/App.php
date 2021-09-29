<?php
class App {
	public function route($route, $controller, $action, $method="GET", $api=false) {
		if($_SERVER["REQUEST_METHOD"] === $method) {
			if (isset($_GET["route"]) && $_GET["route"] == $route)
				(new $controller())->$action($api);
		}
	}
	public function get($route, $controller, $action, $api=false){
		$this->route($route, $controller, $action, "GET", $api);
	}
	public function post($route, $controller, $action,$api=false){
		$this->route($route, $controller, $action, "POST", $api);
	}
}