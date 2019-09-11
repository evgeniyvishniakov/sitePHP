<?php
/**
 * Created by PhpStorm.
 * User: Евгений
 * Date: 04.09.19
 * Time: 16:42
 */

namespace admin\controllers;


use admin\models\ShowModel;
use core\controllers\ViewsController;

class ShowController extends ShowModel implements ViewsController
{
    protected $view_file;
    protected $name_table;
    protected $name_id;
    protected $model_show;

    public function __construct($view_file)
    {
        $this->view_file = $view_file;
        $this->name_table = $_GET['table'];
        $this->name_id = $_GET['id'];
        $this->model_show = new ShowModel();
    }

    public function render()
    {

        if (file_exists('./app/admin/views/' . $this->view_file . '.php')) {

            require './app/admin/views/' . $this->view_file . '.php';

        }
    }

}