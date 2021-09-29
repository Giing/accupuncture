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
	
	public function logout() {
		global $data;
		try {
			$_SESSION["user"]=false;
			echo $this->view('home',["user"=>$_SESSION["user"]]);

		} catch(Exception $e) {
			die('Error ' . $e->getMessage());
		}
	}

	public function addUser() {
		try {
			global $data;
			$data = Users::getbyEmail($_POST["email"]);
			if($data == null) {
				$user = new Users();
				$user->mail = $_POST["email"];
				$user->password = $_POST["password"];
				if($user->password == $_POST["confirmPassword"]) {
					$user->insert();
					$_SESSION["user"]=true;
					echo $this->view('home',["user"=>$_SESSION["user"]]);
				} else {
					echo $this->view('register',["errorMessage"=>"Passwords don't match"]);
				}
			} else {
				echo $this->view('register',["errorMessage"=>"An account already exists for this email."]);
			}	
			

		} catch(Exception $e) {
			die('Error ' . $e->getMessage());
		}
	}

	public function connect() {
		try {
			global $data;
			$data = Users::getbyEmail($_POST["email"]);
			if($data != null) {
				if(password_verify($_POST["password"],$data->password)){
					$_SESSION["user"] = true;
					echo $this->view('home',["user"=>$_SESSION["user"]]);
				} else {
					echo $this->view('login',["errorMessage"=>"Password incorrect."]);
				}
			} else {
				echo $this->view('login',["errorMessage"=>"Email not found."]);
			}

		} catch(Exception $e) {
			die('Error ' . $e->getMessage());
		}
	}
}

