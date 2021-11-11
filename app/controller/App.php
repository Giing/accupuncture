<?php

class App {
	// App's entry point

	private ViewController $viewController;

	public function __construct() {
		$this->viewController = new ViewController();
	}

	/**
	 * Define route accessible by the $route parameter
     * @param String	$route   		route's path
     * @param String	$controller     controller to load
	 * @param String	$action			method to call
	 * @param String	$method			http call method
	 * @param Boolean	$api			should this route accessible via the API
	 *
	 * @construct route
	 *
	 * @throws BadRequestHttpException
	 */
	public function route($route, $controller, $action, $method="GET", $api=false) {
		if($_SERVER["REQUEST_METHOD"] === $method) {
			if (isset($_GET["route"]) && $_GET["route"] == $route) {
				$this->viewController->render((new $controller())->$action(), $api && array_key_exists("api", $_GET));
				exit;
			}
		}

		if($route == "notFound") {
			header("HTTP/1.1 404 Not Found", true, 404);
		}
	}

	/**
	 * Shortcut for GET Http method
	 * 
	 * @construct route
	 *
	 * @throws BadRequestHttpException
	 */
	public function get($route, $controller, $action, $api=false){
		$this->route($route, $controller, $action, "GET", $api);
	}

	/**
	 * Shortcut for POST Http method
	 * 
	 * @construct route
	 *
	 * @throws BadRequestHttpException
	 */
	public function post($route, $controller, $action, $api=false){
		$this->route($route, $controller, $action, "POST", $api);
	}
}