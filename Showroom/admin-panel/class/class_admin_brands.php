<?php 

include_once 'class_connect.php';

class Admin_Brands{
    
    
    function brands_list(){

        $connect = new connectBD();
        $connect->connect();

        $query_1 = $connect->pdo->query("SELECT * FROM brands");
        $row = $query_1->fetchAll();

        return $row;

        $connect->closeConnect();
    }
}
?>