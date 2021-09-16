<?php

$data = null;

class UserController extends BaseController{

	public function index() {
		global $data;
		try {

			echo $this->view('login');

		} catch(Exception $e) {
			die('Error ' . $e->getMessage());
		}
	}

	public function login() {
		global $data;
		try {
			echo $this->view('testPage',["users" => $_POST]);

		} catch(Exception $e) {
			die('Error ' . $e->getMessage());
		}
	}

}

