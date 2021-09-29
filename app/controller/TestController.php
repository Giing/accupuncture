<?php

class TestController extends BaseController {

	
	public function index($api) {
		try {
			echo $this->view('home', ["Lundi" => "Papaille"], $api);
		} catch(Exception $e) {
			die('Error ' . $e->getMessage());
		}
	}
}

