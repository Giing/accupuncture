<?php 

require_once "../vendor/autoload.php";

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class BaseController {


    public function view($filename, $params=[]) {
        try {
            $loader = new FilesystemLoader('views');
            $twig = new Environment($loader, ['debug' => true]);
            $twig->addExtension(new \Twig\Extension\DebugExtension());
            $view = $twig->load($filename . ".html");

            return $view->render($params);

        } catch(Exception $e) {
            die('Error ' . $e->getMessage());
        }

    }
}