<?php

class Users extends Model {
    public function insert() {
		$class = get_called_class();
		$table =  strtolower($class);
		$sql = "insert into public.$table(email, password) values(:mail, :password)";
		$stm = db()->prepare($sql);
		$stm->bindvalue(":mail", $this->mail);
		$stm->bindvalue(":password", password_hash($this->password,PASSWORD_BCRYPT));
		$stm->execute();
	}

    public static function getbyEmail($email) {
		$class = get_called_class();
		$table =  strtolower($class);
		$st = db()->prepare("select * 
			from public.$table 
			where email = :email");
		$st->bindValue(':email', $email);
		$st->execute();
		$row = $st->fetch(PDO::FETCH_ASSOC);
		if($row!=null)
		{
			$o = new $class();
			foreach($row as $attr => $value)
				$o->$attr = $value;
			return $o;
		}
		else 
			return null;
	}
}
