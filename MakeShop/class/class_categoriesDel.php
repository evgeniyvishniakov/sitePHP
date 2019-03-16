<?php 
include_once 'class_connect.php';

class CategoriesDel{

    private $delet;
    
    function __construct($delet) {

		$this->delet = $delet;
        
    }

    public function CategoriesDelet(){

        $connect = new connectBD();
		$connect->connect();

		$query_1 = $connect->pdo->query("DELETE FROM categories WHERE id=$this->delet");


		$connect->closeConnect();

    }
}    
  