<?php 

include_once 'class_connect.php';

class Admin_Products{


    function __construct($name, $foto, $price, $sale, $size, $color, $categories_name, $child_cat_name, $child_cat_id, $categories_id, $brand, $quantity){
        $this->name = htmlspecialchars($name);
        $this->foto = htmlspecialchars($foto);
        $this->price = $price;
        $this->sale = $sale;
        $this->size = $size;
        $this->color = $color;
        $this->categories_id = $categories_id;
        $this->categories_name = $categories_name;
        $this->child_cat_name = $child_cat_name;
        $this->child_cat_id = $child_cat_id;
        $this->brand = $brand;
        $this->quantity = $quantity;
        $this->id_del = $id_del;
    }

    // Выбираем по одному товару в масив (для редактирования, проверки)
    function products($id){

        $connect = new connectBD();
        $connect->connect();

        $query_1 = $connect->pdo->query("SELECT * FROM products WHERE id = '$id'");
        $row = $query_1->fetchAll();

        return $row;

        $connect->closeConnect();
    }

    // Выводим список товаров (СОРТИРОВКА)
    function products_list(){

        $connect = new connectBD();
        $connect->connect();

        $query_1 = $connect->pdo->query("SELECT * FROM products ORDER BY id DESC");
        $row = $query_1->fetchAll();

        return $row;

        $connect->closeConnect();
    }

    // Добавление товаров
    function products_add(){

        $connect = new connectBD();
        $connect->connect();

        $add = $connect->pdo->prepare("INSERT INTO products (foto, name, price, sale, size, color, categories_name, categories_id, child_cat_name, child_cat_id, brand, quantity) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
        $add->execute(array($this->foto,$this->name,$this->price,$this->sale,$this->size,$this->color,$this->categories_name,$this->categories_id,$this->child_cat_name,$this->child_cat_id,$this->brand,$this->quantity));

        if ($add)
            return true;
        else false;

        $connect->closeConnect();
    }

    // Удаление товаров
    function products_del($id_del){

        $connect = new connectBD();
        $connect->connect();

        $del = $connect->pdo->query("DELETE FROM products WHERE id = '$id_del'");

        $connect->closeConnect();
    }

    // Редактирование товаров
    function products_edit($id_edit){

        $connect = new connectBD();
        $connect->connect();

        $edit = $connect->pdo->query("UPDATE products SET name = '$this->name', foto = '$this->foto', price = '$this->price', sale = '$this->sale', size = '$this->size', color = '$this->color', categories_name = '$this->categories_name', child_cat_name = '$this->child_cat_name', child_cat_id = '$this->child_cat_id', categories_id = '$this->categories_id',  brand = '$this->brand', quantity = '$this->quantity'  WHERE id = '$id_edit'");

        $connect->closeConnect();
    }

}    
?>