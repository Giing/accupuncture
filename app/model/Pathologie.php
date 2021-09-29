<?php

class Pathologie extends Model {

    public static function getAll() {
		$st = db()->prepare("select * from public.patho p order by p.desc asc");
		$st->execute();
		$list = array();
		while($row = $st->fetch(PDO::FETCH_ASSOC)) {
			$h = array();
			foreach($row as $field=>$value)
				$h[$field] = $value;
			$list[] = $h;
		}
		return $list;
    }

}