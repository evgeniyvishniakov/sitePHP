<?php 
include_once 'class_connect.php';




class Authentication { 

		private $email_class;
		private $login_class;


    function __construct($login,$password) {

		$this->login_class = htmlspecialchars($login);
		$this->password_class = htmlspecialchars($password);
    }

    public function Auth(){ // основная ф-ия аворизации
      
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
	
		if ($this->login_class){

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
	
		if ($this->password_class){

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
						if ($this->login_class === $key['login'] && md5($this->password_class) === $key['password']){
							return true;
						}else 
							return false;
					}
        }
        
        $connect->closeConnect();
	}
}

?>