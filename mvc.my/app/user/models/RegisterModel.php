<?php 

namespace user\models;

use core\models\BaseModel;

class RegisterModel extends BaseModel{
	
	protected function LoginDB($login){ // Свободен или занят логин в базе

		$sql = "SELECT COUNT(*) FROM register WHERE login = '$login'";
		$res = $this->connect()->query($sql);
		$row = $res->fetch_row();
		
		return $row;

	}

    protected function addAccountDB($login, $email, $password){ // Добавление в базу (логина,пароля,почты)
	
		$sql = "INSERT INTO register SET login = '$login', email = '$email', password = md5($password)";
		
		$add = $this->connect()->query($sql);

		if ($add)
			return true;
		else false;

		
	}

	
	
}