<?php
include_once '../class/class_connect.php';
//  Удаляет товары через админку!

class ProductsDel{

    private $delet;
    
    function __construct($delet) {

		$this->delet = $delet;
        
    }

    public function ProductsDelet(){

    $connect = new connectBD();
		$connect->connect();

		$query_1 = $connect->pdo->query("DELETE FROM products WHERE id=$this->delet");


		$connect->closeConnect();

    }
}

?>