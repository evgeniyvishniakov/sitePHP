<?php 
include_once 'class__register.php';
include_once 'class_connect.php';




class Authentication extends CreaterAccount { // Наследование с класса регистрация


    function __construct($login,$password) {

		$this->login_class = htmlspecialchars($login);
		$this->password_class = htmlspecialchars($password);
		$this->maxLentghLogin = 12;
		$this->maxLengthPassword = 32;
		$this->minLentghLogin = 6;
		$this->minLengthPassword = 12;
    }

    public function addAuth(){ // основная ф-ия аворизации
      
        if ($this->checkLogin()) {
            
			if ($this->checkPassword()){

                if ($this->checkRegisterBD())
                    return true;
                else 
                    return false;
            }
            else 
                {return false;}
		}else 
			{return false;}
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
    
    public function checkRegisterBD(){ //если логин существует в базе то проверяем пароль

        $connect = new connectBD();
        $connect->connect();

        $query_1 = $connect->pdo->query("SELECT * FROM register WHERE login = '$this->login_class'");
		$row = $query_1->fetchAll();
		
	
        if ($row === Array()){
          return false;
        }
        else{

           foreach ($row as $key) {
				if ($this->login_class === $key['login'] && $this->password_class === $key['password']){
					return true;
				}else 
					return false;
			}
        }
        
        $connect->closeConnect();
	}
}

?>