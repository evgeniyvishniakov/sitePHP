<?php 
include_once 'class_connect.php';

Class Products{
    
    //вывод все товаров на страницу с сортировкой по возрастанию идентификатора
    function products_list(){

        $connect = new connectBD();
        $connect->connect();

        $query_1 = $connect->pdo->query("SELECT * FROM products ORDER BY id DESC");
        $row = $query_1->fetchAll();

        return $row;

        $connect->closeConnect();
    }

    // сортировка по категориям
    function products_list_categories($cat_id, $child_id){

        $connect = new connectBD();
        $connect->connect();

        $query_1 = $connect->pdo->query("SELECT * FROM products WHERE categories_id = $cat_id AND child_cat_id = $child_id");
        $row = $query_1->fetchAll();

        return $row;

        $connect->closeConnect();
    }
}
?>