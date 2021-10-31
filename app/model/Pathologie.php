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
		$st = db()->prepare("select * from public.patho p where idp IN (".implode(',', $filters).") order by p.desc asc");
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

	public static function getPathosFromType($type) {
		$st = db()->prepare("select * from public.patho p where type LIKE '".addslashes($type)."' order by p.desc asc");
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