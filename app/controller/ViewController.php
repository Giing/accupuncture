<?php


require_once "../vendor/autoload.php";

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class ViewController {
    public function render($result, $api) {
        $filename = $result["view"];
        $params = $result["params"];
    
        $result = NULL;

        if($api) {
            $result = $this->api($params);
        } else {
            $result = $this->twig($params, $filename);
            print_r($result);
        }
        echo $result;
    }
    
    private function twig($params, $filename) {
        $loader = new FilesystemLoader('views');
        $twig = new Environment($loader);
        $view = $twig->load($filename . ".html");
    
        return $view->render($params);
    }
    
    private function api($params) {
        return json_encode($params);
    }
}