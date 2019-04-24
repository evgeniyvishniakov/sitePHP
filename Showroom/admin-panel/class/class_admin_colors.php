<?php 

include_once 'class_connect.php';

class Admin_Colors{
    
    
    function colors_list(){

        $connect = new connectBD();
        $connect->connect();

        $query_1 = $connect->pdo->query("SELECT * FROM colors");
        $row = $query_1->fetchAll();

        return $row;

        $connect->closeConnect();
    }
}