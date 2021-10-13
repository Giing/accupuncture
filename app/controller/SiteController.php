<?php

class SiteController extends BaseController {
	public function index() {

		try {
			return $this->view('home');
		} catch(Exception $e) {
			die('Error ' . $e->getMessage());
		}
	}
}

