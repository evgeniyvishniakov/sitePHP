<?php
/**
 * Created by PhpStorm.
 * User: Евгений
 * Date: 07.09.19
 * Time: 13:04
 */

namespace admin\controllers;


use admin\models\AddModel;
use admin\models\AtributesModel;
use admin\models\ShowModel;
use core\controllers\ViewsController;
use core\models\BaseModelMethods;


class AddController extends AddModel implements ViewsController

{
    protected $view_file;
    protected $name_table;
    protected $model_show;
    protected $model_add;
    protected $file;


    public function __construct($view_file)
    {
        $this->view_file = $view_file;
        $this->name_table = $_GET['table'];
        $this->model_add = new AddModel();
        $this->model_show = new ShowModel();
        $this->file = new FileEdit();
        $this->model_atribute = new AtributesModel();

    }

    public function render()
    {

        if (file_exists('./app/admin/views/' . $this->view_file . '.php')) {

            require './app/admin/views/' . $this->view_file . '.php';

        }
    }

    public function addProduct(){


        $insert_product = '';
        $products = [];
        $data = date("Y-m-d");

        foreach($_POST as $value => $key){
            $products[$value] = htmlspecialchars($key);
        }

        unset($products['save']);

        foreach($products as $value => $key){

            if($key === ''){
                $key = 'NULL';
            }

            if(is_numeric($key)){

                $insert_product .= $value . " = " . $key . ", " ;
            }else{
                $insert_product .= $value . " = " . "'" . $key . "', ";
            }

        }
        $insert_product .= "foto = " . "'" . $_FILES['foto']['name'] . "'," ;

        $insert_product .= "foto_gallery = " . "'" . implode(',', $_FILES['files']['name']) . "'," ;

        $this->file->addFile();

        $insert_product = rtrim($insert_product, ', ');

        if($this->model_add->add($this->name_table, $insert_product))return true; return false;

    }




}