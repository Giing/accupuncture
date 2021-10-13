<?php

class TestController extends BaseController {

	
	public function index() {
		try {
			return $this->view('home', ["Lundi" => "Papaille"]);
		} catch(Exception $e) {
			die('Error ' . $e->getMessage());
		}
	}
}

