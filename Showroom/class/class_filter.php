<?php 
include_once 'class_connect.php';

	/**
	* Класс формирует массив с отвильтроваными товарами
	**/

class Filter{

	
	/**
	* Получаем с базы данные 
	**/

    public function filterBD(){

        $connect = new connectBD();
        $connect->connect();


        $query_1 = $connect->pdo->query("SELECT * FROM products WHERE $this->parents_cat $this->child_cat $this->brand $this->size $this->color $this->price");
        $row = $query_1->fetchAll();

        return $row;

        $connect->closeConnect();
    }
	
	/**
	* Родительские категории
	**/
	
    public function filter_parents_cat($array_parents_cat){

        $name_parents_cat = $array_parents_cat['Perents_cat'];

        if ($name_parents_cat) { // если не пусто

            $name_parents_cat = implode("','" , $name_parents_cat); // переобразовуем масив в строку 

            $this->parents_cat = "categories_name in ('$name_parents_cat') and"; 

        }else {
            $this->parents_cat = ""; // либо пусто
        }
	}
	
	/**
	* Дочерние категории
	**/
	
    public function filter_child_cat($array_сhild_cat){

        $name_child_cat = $array_сhild_cat['Child_cat'];

        if ($name_child_cat) { // если не пусто

            $name_child_cat = implode("','" , $name_child_cat); // переобразовуем масив в строку 

            $this->child_cat = "child_cat_name in ('$name_child_cat') and"; 

        }else {
            $this->child_cat = ""; // либо пусто
        }
	}

    /**
	* Бренд
	**/
	
    public function filter_brand($array_brand){

        $name_brand = $array_brand['Brand'];

        if ($name_brand) { // если не пусто

            $name_brand = implode("','" , $name_brand); // переобразовуем масив в строку 

            $this->brand = "brand in ('$name_brand') and"; 

        }else {
            $this->brand = ""; // либо пусто
        }
	}

    /**
	* Цена
	**/
    public function filter_price($array_price){

        $name_price = $array_price['Price'];

        if ($name_price) { // если цена существует
    
            $this->price = "price between $name_price"; // выводим выбраную цену
            
        }else{
            $this->price = 'price between 0 and 1500';
        }
    }

    /**
	* Размер
	**/
    public function filter_size($array_size){

        $name_size = $array_size['Size'];

        if ($name_size) { // если масив существует

            $name_size = implode("','" , $name_size); // переобразовуем масив в строку 
    
            $this->size = "size in ('$name_size') and";

        }else{
            $this->size = ''; // если масив пустой выводим пустую строку
        }   
    }
    
    /**
	* Цвет
	**/
    public function filter_color($array_color){

        $name_color = $array_color['Color'];

        if (!empty($name_color)) { // если масив существует

            $name_color = implode("','" , $name_color); // переобразовуем масив в строку 
    
            $this->color = "color in ('$name_color') and";

        }else{
            $this->color = ''; // если масив пустой выводим пустую строку
        }   
    }


      
}




?>