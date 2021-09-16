<?php

$data = null;

class BeerController {

	public function liste() {
		global $data;
		$data = Beer::all();
		include_once "view/header.php";
		include_once "view/beerList.php";
		include_once "view/footer.php";
	}
	public function random() {
		global $data;
		$data = Beer::random();
		include_once "view/header.php";
		include_once "view/randomBeer.php";
		include_once "view/footer.php";
	}
	public function oneBeer() {
		global $data;
		$data = Beer::load($_GET['idbeer']);
		include_once "view/header.php";
		include_once "view/oneBeer.php";
		include_once "view/footer.php";
	}
	public function addBeer() {

		if (isset($_POST['name']) && isset($_POST['color'])) {
			$b = new Beer();
			$b->name = $_POST['name'];
			$b->color = $_POST['color'];
			$b->insert();
		} else {
			include_once "view/header.php";
			include_once "view/add.php";
			include_once "view/footer.php";			
		}
	}
	public function delete() {
		Beer::delete($_GET['idbeer']);
		header("Location: ?route=beers");
	}

}

