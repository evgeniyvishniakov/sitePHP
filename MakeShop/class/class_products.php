<?php 
include_once 'class_connect.php';
include './admin/class/class_productsView.php';


class Products extends ProductsView{ // Наследует от класа в админке и выводит на екран товары
   
  

  public function Prod_cat($prod_cat){

    $connect = new connectBD();
      $connect->connect();

      $query_1 = $connect->pdo->query("SELECT * FROM products WHERE parents_cat = $prod_cat");
      $row = $query_1->fetchAll();

      return $row;

      $connect->closeConnect(); 
  }

 
  
}    

