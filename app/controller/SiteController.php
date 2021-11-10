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
			$main_pathologies = require __DIR__ . "/../static/pathoTypeName.php";
			return $this->view('pathologies', ["main_pathologies" => $main_pathologies, "chars" => array(), "pathos" => array()]);
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
	public function listPathologiesByMainPathologies() {
		
		$results = array();
		$chars = array();
		
		try {
			$main_pathologies = require __DIR__ . "/../static/pathoTypeSubType.php";
			$key_types = require __DIR__ . "/../static/pathoTypeName.php";
			$type_keys = array_flip($key_types);

			$attribute_types = require __DIR__ . "/../static/pathoSubTypeName.php";
			
			$searched_pathologie = $_GET["main_pathologie"];
			$searched_chars = $_GET["selected_chars"];
			if($searched_pathologie) {
				
				$chars = array_merge($chars, $main_pathologies[$type_keys[$searched_pathologie]]);
				
				if(count($searched_chars) == 0) {
					$searched_chars = $chars;
				}
				foreach($searched_chars as $char) {
					if(!in_array($char, $chars)) {
						$searched_chars = $chars;
						break;
					}
				}

				$pathos = Pathologie::getPathosFromTypeAndChars($searched_pathologie, $searched_chars);
				$results = array_merge($results, $pathos);
			}

			return $this->view('pathologies', [
				"main_pathologies" => $key_types,
				"selected_pathologie" => $searched_pathologie,
				"chars" => $chars, 
				"selected_chars" => $searched_chars,
				"pathos" => array_unique($results, SORT_REGULAR)]
			);
		} catch(Exception $e) {
			die('Error ' . $e->getMessage());
		}
	}

	public function search() {
		return $this->view('search');
	}
}

