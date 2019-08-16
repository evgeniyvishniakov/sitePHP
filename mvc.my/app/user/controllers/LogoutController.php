<?php

namespace user\controllers;

use user\models\LoginModel;
use core\controllers\ViewsController;

class LogoutController extends LoginModel implements ViewsController{

    protected $view_file;


    public function __construct($view_file)
    {
        $this->view_file =  $view_file;

    }

    public function render(){

        if (file_exists('./app/user/views/' . $this->view_file . '.php')){

            require './app/user/views/' . $this->view_file . '.php';

        }
    }

}