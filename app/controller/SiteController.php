<?php



class SiteController extends BaseController {

	
	public function index() {

		try {

			$pathos = Pathologie::getAll();
			foreach($pathos as &$patho){
				$patho["symptomes"] = Symptome::getByPatho($patho["idp"]);
			}
			echo $this->view('home', ["pathologies" => $pathos, "Lundi" => $pathos]);

		} catch(Exception $e) {
			die('Error ' . $e->getMessage());
		}
	}

	public function listAll() {
		try {
			$pathos = Pathologie::getAll();
			foreach($pathos as &$patho){
				$patho["keywords"] = array();
				$patho["symptomes"] = Symptome::getByPatho($patho["idp"]);
				foreach($patho["symptomes"] as $symptome) {
					$patho["keywords"] = array_merge((array)Keyword::getBySymptoms($symptome->ids), (array)$patho["keywords"]);
				}
				$patho["keywords"] = array_unique($patho["keywords"]);
				sort($patho["keywords"]);
			}
			echo $this->view('listAll', ["pathologies" => $pathos]);

		} catch(Exception $e) {
			die('Error ' . $e->getMessage());
		}
	}

	

}

