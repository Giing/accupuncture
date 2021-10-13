<?php



class SiteController extends BaseController {
	public function index() {

		try {

			$pathos = Pathologie::getAll();
			foreach($pathos as &$patho){
				$patho["symptomes"] = Symptome::getByPatho($patho["idp"]);
			}
			return $this->view('home', ["pathologies" => $pathos, "Lundi" => $pathos]);

		} catch(Exception $e) {
			die('Error ' . $e->getMessage());
		}
	}

	public function listAll() {
		try {
			$pathos = Pathologie::getAll();
			$symptomes = Symptome::all();
			$keywords = Keywords::all();
			foreach($pathos as &$patho){
				$patho["keywords"] = array();
				$patho["symptomes"] = Symptome::getByPatho($patho["idp"]);
				foreach($patho["symptomes"] as $symptome) {
					$patho["keywords"] = array_merge((array)Keywords::getBySymptoms($symptome->ids), (array)$patho["keywords"]);
				}
				$patho["keywords"] = array_unique($patho["keywords"]);
				sort($patho["keywords"]);
			}
			return $this->view('listAll', ["pathologies" => $pathos, "symptomes" => $symptomes, "keywords" => $keywords]);

		} catch(Exception $e) {
			die('Error ' . $e->getMessage());
		}
	}

	public function search() {
		return $this->view('search');
	}
}

