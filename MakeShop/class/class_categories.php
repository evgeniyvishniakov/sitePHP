<?php 
include_once 'class_connect.php';

class Categories{
    
    
    function CategoriesBD(){

        $connect = new connectBD();
        $connect->connect();

        $query_1 = $connect->pdo->query("SELECT * FROM categories");
        $row = $query_1->fetchAll();

        $arr_cat = array();

        foreach ($row as $key) {
            $arr_cat[$key['id']] = $key;
            
        }

        return $arr_cat;

        $connect->closeConnect();
    }

    /**
    * Построение дерева
    **/
    function map_tree(){

        $tree = array();

        $arr_cat = $this->CategoriesBD();

        foreach ($arr_cat as $id=>&$node) {    

            if (!$node['parents_cat']){
                $tree[$id] = &$node;
            }else{ 
                $arr_cat[$node['parents_cat']]['childs'][$id] = &$node;
            }
        }
        return $tree;
    }

}



?>