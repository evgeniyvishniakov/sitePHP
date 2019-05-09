<?php 
include_once 'class_connect.php';


class Filter_Atribute{


    public function size_atribute(){
    $connect = new connectBD();
        $connect->connect();

        $query_1 = $connect->pdo->query("SELECT * FROM sizes");
        $row = $query_1->fetchAll();

        return $row;

        $connect->closeConnect();
    }

}