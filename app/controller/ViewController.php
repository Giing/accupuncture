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
        header('Content-Type: application/json; charset=utf-8');
        return json_encode($params, JSON_PRETTY_PRINT | JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE);
    }
}