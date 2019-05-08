<?php 
include_once 'class_connect.php';


class Filter{


    public function __conctruct(){

        $this->brand = $brand;
        $this->price = $price;
        $this->size = $size;
        $this->color = $color;
    }


    public function filterBD(){

        $connect = new connectBD();
        $connect->connect();


        $query_1 = $connect->pdo->query("SELECT * FROM products WHERE $this->size $this->color $this->brand and ($this->price)");
        $row = $query_1->fetchAll();

        return $row;

        $connect->closeConnect();
    }

    // фильтр бренд
    public function filter_brand($array){

        $name_brand = $array['Brand'];

        $this->brand = "brand in ('$name_brand')";
    }

    // фильтр цены
    public function filter_price($array_price){

        $name_price = $array_price['Price'];

        if ($name_price) { // если цена существует
    
            $this->price = "price between $name_price"; // выводим выбраную цену
            
        }else{
            $this->price = 'price between 0 and 1500';
        }

    }

    // фильтр размера
    public function filter_size($array_size){

        $name_size = $array_size['Size'];

        if ($name_size) { // если масив существует

            $name_size = implode("," , $name_size); // переобразовуем масив в строку 
    
            $this->size = "size in ('$name_size') and";

        }else{
            $this->size = ''; // если масив пустой выводим пустую строку
        }

        
    }
    
    // фильтр цвета
    public function filter_color($array_color){

        $name_color = $array_color['Сolor'];

        if ($name_color) { // если масив существует

            $name_color = implode("," , $name_color); // переобразовуем масив в строку 
    
            $this->color = "color in ('$name_color') and";

        }else{
            $this->color = ''; // если масив пустой выводим пустую строку
        }

        
    }


      
}




?>