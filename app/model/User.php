<?php

class User extends Model {
    public function insert() {
		$sql = "insert into public.user(email, password) values(:mail, :password)";
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
        $o = new $class();
        foreach($row as $attr => $value)
            $o->$attr = $value;
        if ($o != new $class()) {
            return $o;
        }
        else {
            return null;
        }
        
	}
}
