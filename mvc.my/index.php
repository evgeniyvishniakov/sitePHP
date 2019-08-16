<?php 
session_start();
ob_start();
require_once _DIR_ . '/../vendor/autoload.php';
require 'app/core/controllers/RouteController.php';
$route = new RouteController();






