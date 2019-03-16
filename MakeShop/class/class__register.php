<?php 
include_once 'class_connect.php';



class CreaterAccount{

	private $email_class;
	private $login_class;
	private $password_class;
	private $maxLentghLogin;
	private $maxLengthPassword;
	private $minLentghLogin;
	private $minLengthPassword;

	function __construct($login,$email,$password) {

		$this->email_class = htmlspecialchars($email);
		$this->login_class = htmlspecialchars($login);
		$this->password_class = htmlspecialchars($password);
		$this->maxLentghLogin = 12;
		$this->maxLengthPassword = 32;
		$this->minLentghLogin = 6;
		$this->minLengthPassword = 12;

	}

	public function register(){ // основная ф-ия регистра , true - регистрация успешна - false - не успешна
	

		if ($this->checkLoginBD()){
			return false;
		}
		else{	
			
			if ($this->checkLogin()){
				
				if ($this->checkPassword()){

					if($this->checkEmail()){
							
						if($this->addAccountDB())
								return true;
							else 
								return false;

					}
					else 
						{return false;}
				}
				else 
					{return false;}
			} 
			else 
				{return false;}
		}
	}

	public function addAccountDB(){ // Добавление в базу (логина,пароля,почты)
	
		$connect = new connectBD();
		$connect->connect();

		$add = $connect->pdo->prepare("INSERT INTO register (login,password,email) VALUES (?,?,?)");
		$add->execute(array($this->login_class,$this->password_class,$this->email_class));

		if ($add)
			return true;
		else false;

		$connect->closeConnect();
	}

	public function checkLogin(){ // Проверка логина на регулярные выражения
	
		if (strlen($this->login_class) >= $this->minLentghLogin && strlen($this->login_class) <= $this->maxLentghLogin){

			$notcorrectsymbolTwo = "!@\"#№;$%^:&?*()-_+=//|\\`.,";
			$reg = "/[а-Я]/";
			$bool = false;
			for ($i = 0; $i < strlen($this->login_class); $i++) {

				for ($j = 0; $j < strlen($notcorrectsymbolTwo); $j++) 
					if ($this->login_class[$i] == $notcorrectsymbolTwo[$j])
						$bool = true;
			}

			if ($bool != true) {

				if (!preg_match($reg, $this->login_class))
						return true;
				else
					return false;
			}
			else 
				return false;
		}
		else
			return false;

	}

	public function checkEmail(){ // Проверка почты на валидность

		if (filter_var($this->email_class,FILTER_VALIDATE_EMAIL))
			return true;
		else 
			return false;
	}

	public function checkPassword(){  // Проверка пароля на регулярные выражения
	
		if (strlen($this->password_class) >= $this->minLengthPassword && strlen($this->password_class) <= $this->maxLengthPassword){

			$notcorrectsymbolTwo = "!@\"#№;$%^:&?*()-_+=//|\\`.,";
			$reg = "/[а-Я]/";
			$bool = false;

			for ($i = 0; $i < strlen($this->password_class); $i++){

				echo $bool;
				for ($j = 0; $j < strlen($notcorrectsymbolTwo); $j++) 

					if ($this->password_class[$i] == $notcorrectsymbolTwo[$j]){
						$bool = true;

						if ($bool == true)
							echo $this->password_class[$i];
					}
			}

			if ($bool != true){

				if (!preg_match($reg, $this->password_class))
						return true;
				else
					return false;
			}
			else 
				return false;
		}
		else
			return false;
	}


	private function checkLoginBD(){ // Свободен или занят логин в базе
	
		$connect = new connectBD();
		$connect->connect();

		$query_1 = $connect->pdo->prepare("SELECT * FROM register WHERE login = ?");
		$query_1->execute(array($this->login_class));

		if (($row_1 = $query_1->fetch()) > 0)
			return true;
		else 
			return false;

		$connect->closeConnect();
	}
}


?>