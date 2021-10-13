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
}