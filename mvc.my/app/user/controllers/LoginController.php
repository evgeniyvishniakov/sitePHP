<?php

namespace user\controllers;

use user\models\LoginModel;
use core\controllers\ViewsController;

class LoginController extends LoginModel implements ViewsController{

    protected $view_file;

    private $model_auth;
    private $login;
    private $pass;

    public function __construct($view_file)
    {
        $this->login = htmlspecialchars($_POST['login_auth']);
        $this->pass = htmlspecialchars($_POST['pass_auth']);

        $this->view_file =  $view_file;

        $this->model_auth = new LoginModel();

    }

    public function render(){

        if (file_exists('./app/user/views/' . $this->view_file . '.php')){

            require './app/user/views/' . $this->view_file . '.php';

        }
    }

    public function checkAuth(){

        $error_log = 'Такого логина не существует';
        $error_pass = 'Неправильный пароль';

    $auth_login = $this->model_auth->AuthLogin($this->login);

        if($auth_login){
            foreach ($auth_login as $value) {
                if ($value['password'] === md5($this->pass)) {
                     $_SESSION['auth'] = 1;
                    header('Location: http://mvc.my');
                    ob_end_flush();
                    exit;

                } else {

                    return $error_pass;
                }
            }
        }else{
            return $error_log ;
        }


    }

}