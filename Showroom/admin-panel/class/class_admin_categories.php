<?php 

include_once 'class_connect.php';

class Admin_Categories{
    
    
    function CategoriesParents(){

        $connect = new connectBD();
        $connect->connect();

        $query_1 = $connect->pdo->query("SELECT * FROM categories WHERE id > 1 AND id < 4");
        $row = $query_1->fetchAll();

        return $row;

        $connect->closeConnect();
    }

    function CategoriesChilds($id){

        $connect = new connectBD();
        $connect->connect();

        $query_1 = $connect->pdo->query("SELECT * FROM categories WHERE parent_id = '$id'");
        $row = $query_1->fetchAll();

        return $row;

        $connect->closeConnect();
    }
}
?>