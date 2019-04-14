<?php 

include_once 'class_connect.php';

class Categories{
    
    
    function CategoriesParents($id){

        $connect = new connectBD();
        $connect->connect();

        $query_1 = $connect->pdo->query("SELECT * FROM categories WHERE parent_id = $id");
        $row = $query_1->fetchAll();

        return $row;

        $connect->closeConnect();
    }
}
?>