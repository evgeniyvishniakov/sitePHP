<?php
/**
 * Created by PhpStorm.
 * User: Евгений
 * Date: 09.09.19
 * Time: 13:03
 */

namespace admin\controllers;



use admin\models\AddModel;
use admin\models\AtributesModel;
use admin\models\ShowModel;
use core\controllers\ViewsController;

class AddatributeController implements ViewsController
{

    protected $view_file;
    protected $name_table;
    protected $model_show;
    protected $model_add;
    protected $model_atribute;


    public function __construct($view_file)
    {
        $this->view_file = $view_file;
        $this->name_table = $_GET['table'];
        $this->model_add = new AddModel();
        $this->model_show = new ShowModel();


    }

    public function render()
    {

        if (file_exists('./app/admin/views/' . $this->view_file . '.php')) {

            require './app/admin/views/' . $this->view_file . '.php';

        }
    }

    protected function addAtribute(){

        $insert_atribute = '';
        $products = [];


        foreach($_POST as $value => $key){
            $products[$value] = htmlspecialchars($key);
        }

        unset($products['save']);

        foreach($products as $value => $key){

            if($key === ''){
                $key = 'NULL';
            }

            if(is_numeric($key)){

                $insert_atribute .= $value . " = " . $key . ", " ;
            }else{
                $insert_atribute .= $value . " = " . "'" . $key . "', ";
            }

            $insert_atribute = rtrim($insert_atribute, ', ');

            if($this->model_add->add($this->name_table, $insert_atribute)){
                return true;
            }


        }
    }



}