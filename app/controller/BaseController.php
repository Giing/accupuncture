<?php 

require_once "../vendor/autoload.php";

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class BaseController {

    /**
	 * Base format to render the different views
     * @param String    $filename   twig html file path
     * @param Array     $params     data to render
	 *
	 * @return View
	 *
	 * @throws BadRequestHttpException
	 */
    public function view($filename, $params=[]) {
        try {
            return ['view' => $filename, 'params' => $params];
        } catch(Exception $e) {
            die('Error ' . $e->getMessage());
        }
    }
}