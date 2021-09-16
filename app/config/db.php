<?php

// TODO : changer l'initialisation des attributs de la classe et faire en sorte de passer par un fichier config
class DB {

    private $host = "localhost";
    private $db = "acudb";
    private $user = "postgres-web";
    private $password = "web";
    private $connec;

    public function __construct() {
        $this->connect();
    }

    private function connect() {

        try {

            $dsn = "pgsql:host=$this->host;port=5432;dbname=$this->db;";
            $pdo = new PDO($dsn, $this->user, $this->password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

            $this->connec = $pdo;
        
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function query($sql,Array $cond = null) {
        $stmt = $this->connec->prepare($sql);

		if($cond){
			foreach ($cond as $v) {
				$stmt->bindParam($v[0],$v[1],$v[2]);
			}
		}

		$stmt->execute();

		return $stmt->fetchAll();
		$stmt->closeCursor();
		$stmt=NULL;
    }

}

$db = new DB();
$test = $db->query("SELECT * FROM keysympt where idk=:idk", [["idk", 3, PDO::PARAM_INT]]);
print_r($test);
require_once "../../vendor/autoload.php";
?>