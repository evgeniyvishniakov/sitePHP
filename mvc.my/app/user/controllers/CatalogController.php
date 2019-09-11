<?php

namespace user\controllers;

use admin\models\AtributesModel;
use user\models\CatalogModel;
use core\controllers\ViewsController;
use user\controllers\FilterController;

class CatalogController extends CatalogModel implements ViewsController
{

    protected $view_file;
    protected $model_catalog;
    protected $model_atribute;


    public function __construct($view_file)
    {

        $this->view_file = $view_file;
        $this->model_catalog = new CatalogModel();
        $this->model_atribute = new AtributesModel();


    }

    public function render()
    {

        if (file_exists('./app/user/views/' . $this->view_file . '.php')) {

            require './app/user/views/' . $this->view_file . '.php';

        }
    }


    public function getAtribute($name_atribute){

        return $this->model_atribute->get($name_atribute);
    }

}
