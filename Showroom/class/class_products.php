<?php 
include_once 'class_connect.php';

Class Products{
    
    function products_list(){

        $connect = new connectBD();
        $connect->connect();

        $query_1 = $connect->pdo->query("SELECT * FROM products ORDER BY id DESC");
        $row = $query_1->fetchAll();

        return $row;

        $connect->closeConnect();
    }
}
?>