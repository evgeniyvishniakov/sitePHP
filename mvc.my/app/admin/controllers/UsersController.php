<?php 

namespace admin\controllers;

use admin\models\UsersModel;
use core\controllers\ViewsController;

class UsersController extends UsersModel implements ViewsController
{
	protected $view_file;

    public function __construct($view_file)
	{
		$this->view_file =  $view_file;
    }

    public function render(){
		
		if (file_exists('./app/admin/views/' . $this->view_file . '.php')){
			
            require './app/admin/views/' . $this->view_file . '.php';

        }
	}
	
	public function ShowProducts(){

		echo 'Продукты';
	
	}

	public function AddProducts(){

	}

	public function EditProducts(){

	}

	public function DeletProducts(){

	}
}