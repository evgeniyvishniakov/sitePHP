<?php 

namespace admin\controllers;

use admin\models\AtributesModel;
use core\controllers\ViewsController;

class AtributesController extends AtributesModel implements ViewsController
{
	protected $view_file;
    protected $model_atributes;

    public function __construct($view_file)
	{
		$this->view_file =  $view_file;
        $this->model_atributes = new AtributesModel();
    }

    public function render(){
		
		if (file_exists('./app/admin/views/' . $this->view_file . '.php')){
			
            require './app/admin/views/' . $this->view_file . '.php';

        }
	}
	
	public function ShowAtributes($name = ''){

        return $this->model_atributes->get($name);
	
	}


}