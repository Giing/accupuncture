<?php

class SiteController extends BaseController {

	
	public function index() {

		try {

			echo $this->view('home', ["Lundi" => "Pipi"]);

		} catch(Exception $e) {
			die('Error ' . $e->getMessage());
		}
		/* include_once "view/header.php";
		include_once "view/home.php";
		include_once "view/footer.php"; */
	}

	

}

