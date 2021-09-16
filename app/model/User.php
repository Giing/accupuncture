<?php

class User extends Model {
    public function insert() {
		$sql = "insert into user(mail, password) values(:mail, :password)";
		$stm = db()->prepare($sql);
		$stm->bindvalue(":mail", $this->mail);
		$stm->bindvalue(":password", password_hash($this->password));
		$stm->execute();
		header("location: .?route=home");
	}
}
