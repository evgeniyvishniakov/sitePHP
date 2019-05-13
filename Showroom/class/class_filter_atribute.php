<?php 
include_once 'class_connect.php';

	/**
	* Класс выводит списки фильров на страницу каталога
	**/

class Filter_Atribute{

	/**
	* Вітягиваем родительские категории
	**/
	public function brand_parents_categories(){ 
		
		$connect = new connectBD();
        $connect->connect();

        $query_1 = $connect->pdo->query("SELECT * FROM categories WHERE id > 1 AND id < 4");
        $row = $query_1->fetchAll();

        return $row;

        $connect->closeConnect();
    }
	
	/**
	* Дочерние категоии
	**/
	public function brand_child_categories(){
		
		$connect = new connectBD();
        $connect->connect();

        $query_1 = $connect->pdo->query("SELECT * FROM child_catategories");
        $row = $query_1->fetchAll();

        return $row;

        $connect->closeConnect();
    }
	
	/**
	* Бренды
	**/
	public function brand_atribute(){
		
		$connect = new connectBD();
        $connect->connect();

        $query_1 = $connect->pdo->query("SELECT * FROM brands");
        $row = $query_1->fetchAll();

        return $row;

        $connect->closeConnect();
    }
	
	/**
	* Размер
	**/
    public function size_atribute(){
		
		$connect = new connectBD();
        $connect->connect();

        $query_1 = $connect->pdo->query("SELECT * FROM sizes");
        $row = $query_1->fetchAll();

        return $row;

        $connect->closeConnect();
    }
	
	
}