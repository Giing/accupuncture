<?php

$data = null;

class UserController extends BaseController{

	public function register() {
		global $data;
		try {

			echo $this->view('register');

		} catch(Exception $e) {
			die('Error ' . $e->getMessage());
		}
	}

	public function login() {
		global $data;
		try {

			echo $this->view('login');

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
				echo $this->view('home');
			}
			else {
				echo $this->view('register',["passwordIncorrect"=>true]);
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
				echo $this->view('home');
			}
			else {
				echo $this->view('login',["passwordIncorrect"=>true]);
			}

		} catch(Exception $e) {
			die('Error ' . $e->getMessage());
		}
	}
}

