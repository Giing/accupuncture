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
	public function listFiltered() {
		try {
			$pathos = Pathologie::getPathosFiltered($_GET["pathologies"]);
			print_r($pathos);
			$symptomes = Symptome::all();
			$keywords = Keywords::all();
			foreach($pathos as &$patho){
				$patho["keywords"] = array();
				$patho["symptomes"] = Symptome::getSymptomesFiltered($patho["idp"],$_GET["symptomes"]);
				/*foreach($path["symptomes"] as $symptome) {
					$patho["keywords"] = array_merge((array)Keywords::getKeywordsFiltered($symptome->ids), (array)$patho["keywords"]);
				}
				$patho["keywords"] = array_unique($patho["keywords"]);
				sort($patho["keywords"]);*/
			}
			return $this->view('listAll', ["pathologies" => $pathos,"symptomes" => $symptomes, "keywords" => $keywords]);

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




	/* List and Filter all symptomes by main pathologies */

	/**
	 * List every main pathologies
	 *
	 * @return View
	 *
	 * @throws BadRequestHttpException
	 */
	public function listAllMainPathologies() {
		try {
			$main_pathologies = array_keys(require __DIR__ . "../static/pathoTypeName.php");
			return $this->view('pathologies', ["main_pathologies" => $main_pathologies, "symptomes" => array()]);
		} catch(Exception $e) {
			die('Error ' . $e->getMessage());
		}
	}

	/**
	 * Search for every symptomes link to the main pathologies
	 *
	 * @return View
	 *
	 * @throws BadRequestHttpException
	 */
	public function listSymptomesByMainPathologies() {
		
		$results = array();
		
		try {
			$main_pathologies = array_keys(require __DIR__ . "../static/pathoTypeSubName.php");
			$key_types = array_keys(require __DIR__ . "../static/pathoTypeName.php");

			$searched_pathologies = $_GET["main_pathologies"];
			foreach($searched_pathologies as $searched_pathologie) {
				$searched_types = $main_pathologies[$searched_pathologie];
				
				foreach($searched_types as $type) {
					$pathos = Pathologie::getPathosFromType($key_types[$type]);

					foreach($pathos as $patho) {
						$symptomes = Symptome::getByPatho($patho->id);
						$results = array_merge($results, $symptomes);
					}
				}
			}

			return $this->view('pathologies', ["main_pathologies" => $key_types, "symptomes" => array_unique($results)]);
		} catch(Exception $e) {
			die('Error ' . $e->getMessage());
		}
	}

	public function search() {
		return $this->view('search');
	}
}

