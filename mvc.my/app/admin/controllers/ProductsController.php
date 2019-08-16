<?php 

namespace admin\controllers;

use admin\models\ProductsModel;
use core\controllers\ViewsController;

class ProductsController extends ProductsModel implements ViewsController
{
	protected $view_file;
    protected $model_products;

    public function __construct($view_file)
	{
		$this->view_file =  $view_file;
		$this->model_products = new ProductsModel();
    }

    public function render(){
		
		if (file_exists('./app/admin/views/' . $this->view_file . '.php')){
			
            require './app/admin/views/' . $this->view_file . '.php';

        }
	}
	
	public function ShowProducts(){

			return $this->model_products->get();	
	
	}

	public function AddProducts(){

        $insert = '';
        $products = [];

		foreach($_POST as $value => $key){
			$products[$value] = htmlspecialchars($key);
		}
		
		unset($products['save_prod']);
		
		foreach($products as $value => $key){
			
			if($key === ''){
				$key = 'NULL';
			}
			
			if(is_numeric($key)){
				
				$insert .= $value . " = " . $key . ", " ;
				
			}else{
				
				$insert .= $value . " = " . "'" . $key . "', ";
			}
			
		}
		
		$insert = rtrim($insert, ', ');
		
		$this->model_products->add($insert);
	}

	public function EditProducts(){

	}

	public function DelProducts(){

	    $del = '';
		
		if($_GET['del']){
			
			$del = $_GET['del'];
			
		}
		
		$this->model_products->del($del);

	}
}




















