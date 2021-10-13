<?php

$data = null;

class UserController extends BaseController{

	public function register() {
		global $data;
		try {
			return $this->view('register');
		} catch(Exception $e) {
			die('Error ' . $e->getMessage());
		}
	}

	public function login() {
		global $data;
		try {
			return $this->view('login');
		} catch(Exception $e) {
			die('Error ' . $e->getMessage());
		}
	}

	public function addUser() {
		try {
			global $data;
			$user = new User();
			$user->mail = $_POST["email"];
			$user->password = $_POST["password"];
			if($user->password == $_POST["confirmPassword"]) {
				$user->insert();
				return  $this->view('home');
			}
			else {
				return $this->view('register',["passwordIncorrect"=>true]);
			}

		} catch(Exception $e) {
			die('Error ' . $e->getMessage());
		}
	}

	public function connect() {
		try {
			global $data;
			$data = User::getbyEmail($_POST["email"]);
			if($data != null) {
				return $this->view('home');
			}
			else {
				return $this->view('login',["passwordIncorrect"=>true]);
			}

		} catch(Exception $e) {
			die('Error ' . $e->getMessage());
		}
	}
}

