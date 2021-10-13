<?php

class Symptome extends Model {

    public static function getByPatho($idPatho) {
		$sql = "select sy.idS, sy.desc from public.symptome sy
                JOIN public.symptpatho syp
                    ON sy.ids=syp.ids
                WHERE syp.idp = :id
                ORDER BY sy.desc asc";
        $st = db()->prepare($sql);
        $st->bindValue(':id', $idPatho);                             
		$st->execute();
		$list = array();
		while($row = $st->fetch(PDO::FETCH_ASSOC)) {
			$h = new Symptome();
			foreach($row as $field=>$value)
				$h->$field = $value;
			$list[] = $h;
		}
		return $list;
    }

}