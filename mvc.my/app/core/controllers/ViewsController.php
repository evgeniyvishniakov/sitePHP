<?php


namespace core\controllers;

use core\controllers\RouteController;

interface ViewsController

{
    public function __construct($view_file);
	

    public function render();
		    
}