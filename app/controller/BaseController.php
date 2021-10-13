<?php 

require_once "../vendor/autoload.php";

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class BaseController {


    public function view($filename, $params=[]) {
        try {
            return ['view' => $filename, 'params' => $params];
        } catch(Exception $e) {
            die('Error ' . $e->getMessage());
        }
    }

    public function twig($filename, $params) {
        $loader = new FilesystemLoader('views');
        $twig = new Environment($loader);
        $view = $twig->load($filename . ".html");

        return $view->render($params);
    }

    public function api($params) {
        return json_encode($params);
    }
}