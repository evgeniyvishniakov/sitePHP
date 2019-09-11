<?php
namespace user\controllers;

use core\controllers\ViewsController;

class CartController implements ViewsController{

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