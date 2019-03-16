<?php
include_once '../class/class_connect.php';
class ProductsAdd{

    private $parent_cat;
    private $price;
    private $img;
    private $name;

    function __construct($cat, $price, $img, $name) {

    $this->parent_cat = htmlspecialchars($cat);
    $this->price = htmlspecialchars($price);
    $this->img = htmlspecialchars($img);
    $this->name = htmlspecialchars($name);
    }

    public function addProductsDB(){ // Добавление в базу 

    $connect = new connectBD();
    $connect->connect();

    $add = $connect->pdo->prepare("INSERT INTO products (parents_cat, name, img, price) VALUES (?,?,?,?)");
    $add->execute(array($this->parent_cat, $this->name, $this->img, $this->price));

    if ($add)
        return true;
    else false;

    $connect->closeConnect();
    }
}
