<?php


require_once "../vendor/autoload.php";

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class ViewController {
    /**
	 * Render the right view/format for the client
     * Current type of views:
     * -    HTML
     * -    JSON
     * @param Object  $result   contains the informations to render
     * @param Boolean $api      whether the result supports API calls
	 *
	 * @return View
	 *
	 * @throws BadRequestHttpException
	 */
    public function render($result, $api) {
        $filename = $result["view"];
        $params = $result["params"];
    
        $result = NULL;

        if($api) {
            $result = $this->api($params);
        } else {
            $result = $this->twig($params, $filename);
        }
        echo $result;
    }
    
    // Return the HTML view/format
    private function twig($params, $filename) {
        $loader = new FilesystemLoader('views');
        $twig = new Environment($loader);
        $twig->addGlobal('session', $_SESSION);
        $view = $twig->load($filename . ".html");
        return $view->render($params);
    }
    
    // Return the API (JSON) view/format
    private function api($params) {
        header('Content-Type: application/json; charset=utf-8');
        return json_encode($params, JSON_PRETTY_PRINT | JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE);
    }
}