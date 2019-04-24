<?php 

include_once 'class_connect.php';

class Admin_Sizes{
    
    
    function sizes_list(){

        $connect = new connectBD();
        $connect->connect();

        $query_1 = $connect->pdo->query("SELECT * FROM sizes");
        $row = $query_1->fetchAll();

        return $row;

        $connect->closeConnect();
    }
}