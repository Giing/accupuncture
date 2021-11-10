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

	public static function getPathosFiltered($filters) {
		print_r($filters);
		$st = db()->prepare("select * from public.patho p where p.type IN ".implode(',', $filters)." order by p.desc asc");
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

	public static function getPathosFromTypeAndChars($type, $chars) {
		$attribute_types = array(
			"interne" => "i",
			"externe" => "e",
			"plein" => "p",
			"vide" => "v",
			"chaud" => "c",
			"froid" => "f",
		);
		$filter = "";
		$i=0;
		foreach($chars as $char) {
			if($i > 0) {
				$filter = $filter."|";
			}
			$filter = $filter.$type.$attribute_types[$char];
			$i+=1;
		}
		print_r($query);
		$query = "select * from public.patho p where p.type SIMILAR TO '%($filter)%' order by p.desc asc";
		$st = db()->prepare($query);
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