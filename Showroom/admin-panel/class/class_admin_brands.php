<?php 

include_once 'class_connect.php';

class Admin_Brands{
    
    public function brands_list(){

        $connect = new connectBD();
        $connect->connect();

        $query_1 = $connect->pdo->query("SELECT * FROM brands");
        $row = $query_1->fetchAll();

        return $row;

        $connect->closeConnect();
    }

    public function brands_add($name, $foto){

        $this->foto = htmlspecialchars($foto);
        $this->name = htmlspecialchars($name);

        $connect = new connectBD();
        $connect->connect();

        $add = $connect->pdo->prepare("INSERT INTO brands (name, foto) VALUE (?, ?)");
        $add->execute(array($this->name, $this->foto));

        $connect->closeConnect();
    }

    public function brands_del($id_del){

        $connect = new connectBD();
        $connect->connect();

        $del = $connect->pdo->query("DELETE FROM brands WHERE id = '$id_del'");


        $connect->closeConnect();
    }
}
?>