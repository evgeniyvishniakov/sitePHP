<?php 
include_once 'class_connect.php';

class Routing {

    private $page;
    private $check;

    function __construct($get){

        $this->page = $get;
        $this->check = false;
    }

    public function checkPageBD(){

        $connect = new connectBD();
        $connect->connect();

        $query_1 = $connect->pdo->query("SELECT * FROM name_page WHERE name = '$this->page'");
        $row = $query_1->fetchAll();

        if ($this->page == "") {

            $this->check = true;
            return require_once 'index.php';
        } 

        foreach ($row as $routs => $file){

            if ($routs == $this->page ){
                $this->check = true;
                
                return require_once "views/" . $file['name'] . ".php";

            }
        }

        if($this->check == false)  {

            return require_once 'views/404.php';

        }
        
        $connect->closeConnect();      
    } 
}
?>