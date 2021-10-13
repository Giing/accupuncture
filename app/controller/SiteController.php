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
			$symptomes = Symptome::all();
			$keywords = Keywords::all();
			foreach($pathos as &$patho){
				$patho["symptomes"] = Symptome::getByPatho($patho["idp"]);
				foreach($patho["symptomes"] as $symptome) {
					$symptome->keywords = Keywords::getBySymptoms($symptome->ids);
				}
			}
			echo $this->view('listAll', ["pathologies" => $pathos,"symptomes" => $symptomes,"keywords" => $keywords]);

		} catch(Exception $e) {
			die('Error ' . $e->getMessage());
		}
	}
}

