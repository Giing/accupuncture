<?php

class Model {

	public function __get($attr) {
		return $this->$attr;
	}

	public function __set($attr, $value) {
		$this->$attr = $value;
	}


	public static function all() {
		$class = get_called_class();
		$table =  strtolower($class);
		$st = db()->prepare("select * from public.$table");
		$st->execute();
		$list = array();
		while($row = $st->fetch(PDO::FETCH_ASSOC)) {
			$h = new $class();
			foreach($row as $field=>$value)
				$h->$field = $value;
			$list[] = $h;
		}
		return $list;
	}


	public static function load($id) {
		$class = get_called_class();
		$table =  strtolower($class);
		$st = db()->prepare("select * 
			from $table 
			where id$table = :id");
		$st->bindValue(':id', $id);
		$st->execute();
		$row = $st->fetch(PDO::FETCH_ASSOC);
		$o = new $class();
		foreach($row as $attr => $value)
			$o->$attr = $value;
		return $o;

	}


	public static function random() {
		$class = get_called_class();
		$table =  strtolower($class);
		$st = db()->prepare("select * 
			from $table 
			order by random() limit 1");
		$st->execute();
		$row = $st->fetch(PDO::FETCH_ASSOC);
		$o = new $class();
		foreach($row as $attr => $value)
			$o->$attr = $value;
		return $o;

	}

	public static function delete($id) {
		$class = get_called_class();
		$table =  strtolower($class);
		$stm = db()->prepare("delete from $table where id$table=:id");
		$stm->bindValue(":id", $id);
		$stm = db()->execute();
	}

	/*public static function insert($name, $color) {
		$class = get_called_class();
		$table = strtolower($class);
		$st = db()->prepare("insert into $table values(:name, :color)");
		$st->bindValue(':name', $name);
		$st->bindValue(':color', $color);
		$st->execute();

	}*/




}