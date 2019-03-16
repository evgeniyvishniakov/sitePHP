<?php 

Class ProductsView{

    public function getProductsDB(){

      $connect = new connectBD();
      $connect->connect();

      $query_1 = $connect->pdo->query("SELECT * FROM products");
      $row = $query_1->fetchAll();

      return $row;

      $connect->closeConnect();  
    }
} 