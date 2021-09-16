<?php

class Beer extends Model {
	
	public function insert() {
		$sql = "insert into beer(name, color) values(:name, :color)";
		$stm = db()->prepare($sql);
		$stm->bindvalue(":name", $this->name);
		$stm->bindvalue(":color", $this->color);
		$stm->execute();
		header("location: .?route=beers");
	}
}