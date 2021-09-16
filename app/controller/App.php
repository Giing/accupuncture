<?php
class App {
	public function route($route, $controller, $action) {
		if (isset($_GET["route"]) && $_GET["route"] == $route)
			(new $controller())->$action();
	}
}
