<?php

class Keyword extends Model {

	/***
	 * @return array[String]
	 */
    public static function getBySymptoms($idSymptom) {
		$sql = "select k.name from public.keywords k
                JOIN public.keySympt ks
                    ON k.idK=ks.idK
                WHERE ks.idS = :id
                ORDER BY k.name asc";
        $st = db()->prepare($sql);
        $st->bindValue(':id', $idSymptom);                             
		$st->execute();
		$list = array();
		while($row = $st->fetch(PDO::FETCH_ASSOC)) {
			$h = new Keyword();
			foreach($row as $field=>$value)
				$h->$field = $value;
			$list[] = (string)$h->name;
		}
		return $list;
    }

}