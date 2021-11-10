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

	public static function getPathosBySymptoms($symptoms) {
		$st = db()->prepare("select distinct p.idp, p.desc from public.patho p
							join public.symptpatho sp
								on sp.idp=p.idp
							join public.symptome s
								on s.ids=sp.ids
							where s.desc in (" . $symptoms . ")");
        //$st->bindValue(':symptoms', $symptoms);                             
		$st->execute();
		$list = array();
		while($row = $st->fetch(PDO::FETCH_ASSOC)) {
			$h = new Pathologie();
			foreach($row as $field=>$value)
				$h->$field = $value;
			$list[] = $h;
		}
		return $list;
	}
}