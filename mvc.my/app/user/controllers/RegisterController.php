<?php 

namespace user\controllers;

use user\models\RegisterModel;
use core\controllers\ViewsController;

class RegisterController extends RegisterModel implements ViewsController
{
	protected $view_file;
    private $model_register;
	
	protected $email;
	protected $login;
	protected $pass;
	private $maxLentghLogin;
	private $maxLengthPassword;
	private $minLentghLogin;
	private $minLengthPassword;
    

    public function __construct($view_file)
	{
		$this->view_file =  $view_file;
		
		$this->email = htmlspecialchars($_POST['email']);
		$this->login = htmlspecialchars($_POST['login']);
		$this->pass = htmlspecialchars($_POST['pass']);
		$this->maxLentghLogin = 12;
		$this->maxLengthPassword = 32;
		$this->minLentghLogin = 6;
		$this->minLengthPassword = 12;
		
		$this->model_register = new RegisterModel();
    }

    public function render(){
		
		if (file_exists('./app/user/views/' . $this->view_file . '.php')){
			
            require './app/user/views/' . $this->view_file . '.php';

        }
	}
	
	private function checkLogin(){ // Проверка логина на регулярные выражения
	
		if (strlen($this->login) >= $this->minLentghLogin && strlen($this->login) <= $this->maxLentghLogin){

			$notcorrectsymbolTwo = "!@\"#№;$%^:&?*()-_+=//|\\`.,";
			$reg = "/[а-Я]/";
			$bool = false;
			for ($i = 0; $i < strlen($this->login); $i++) {

				for ($j = 0; $j < strlen($notcorrectsymbolTwo); $j++) 
					if ($this->login[$i] == $notcorrectsymbolTwo[$j])
						$bool = true;
			}

			if ($bool != true) {

				if (!preg_match($reg, $this->login))
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
	
	private function checkEmail(){ // Проверка почты на валидность

		if (filter_var($this->email,FILTER_VALIDATE_EMAIL))
			return true;
		else 
			return false;
	}
	
	private function checkPassword(){  // Проверка пароля на регулярные выражения
	
		if (strlen($this->pass) >= $this->minLengthPassword && strlen($this->pass) <= $this->maxLengthPassword){

			$notcorrectsymbolTwo = "!@\"#№;$%^:&?*()-_+=//|\\`.,";
			$reg = "/[а-Я]/";
			$bool = false;

			for ($i = 0; $i < strlen($this->pass); $i++){

				echo $bool;
				for ($j = 0; $j < strlen($notcorrectsymbolTwo); $j++) 

					if ($this->pass[$i] == $notcorrectsymbolTwo[$j]){
						$bool = true;

						if ($bool == true)
							echo $this->pass[$i];
					}
			}

			if ($bool != true){

				if (!preg_match($reg, $this->pass))
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


	private function checkLoginBD(){

		$register = $this->model_register->LoginDB($this->login);

		if ($register[0] === 1){
            return true;
        }else{
		    return false;
        }
	}
	
	public function register(){ // основная ф-ия регистра , true - регистрация успешна - false - не успешна



		if ($this->checkLoginBD()){
			return false;
			$error_reg['loginBD'] = 'Такое логин существует';
		}
		else{	
			
			if ($this->checkLogin()){
				
				if ($this->checkPassword()){

					if($this->checkEmail()){
							
						if($this->model_register->addAccountDB($this->login, $this->email, $this->pass))
								return true;
							else 
								return false;
							
					}else 
						{return false;}
				}else{
				    return false;
                    $error_reg['login_empty'] = 'Не больше 32 и не меньше';
				}
			}else{
                return false;
                $error_reg['login'] = 'Некоректнный логин';
            }
		}
	}
}	



















