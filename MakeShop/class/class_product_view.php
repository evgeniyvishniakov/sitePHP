<?php 
include_once 'class_connect.php';

class ProductView{

     function Product_view($prod_view){

        $connect = new connectBD();
        $connect->connect();

        $query_1 = $connect->pdo->query("SELECT * FROM products WHERE id = $prod_view");
        $row = $query_1->fetchAll();

        return $row;

        $connect->closeConnect(); 
    }

}

?>