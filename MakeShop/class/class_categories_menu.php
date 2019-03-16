<?php 
include_once 'class_connect.php';

class CategoriesMenu{
    
    
    function CategoriesMenuBD(){

        $connect = new connectBD();
        $connect->connect();

        $query_1 = $connect->pdo->query("SELECT * FROM categories WHERE parents_cat = 0");
        $row = $query_1->fetchAll();

        return $row;

        $connect->closeConnect();
    }

    function CategoriesAllBD(){

        $connect = new connectBD();
        $connect->connect();

        $query_1 = $connect->pdo->query("SELECT * FROM categories");
        $row = $query_1->fetchAll();

        return $row;

        $connect->closeConnect();
    }
    

    function CategoriesParents(){

        $connect = new connectBD();
        $connect->connect();
    
        $query_1 = $connect->pdo->query("SELECT * FROM categories WHERE parents_cat > 0");
        $row = $query_1->fetchAll();
    
        return $row;
    
        $connect->closeConnect();
    }
}




?>
