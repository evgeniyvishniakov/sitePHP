<?php
session_start();
ob_start();

include_once 'class/class_routing.php';


$get = $_GET['page'];
$routing = new Routing($get);



require_once 'view/head.php';
require_once 'view/header.php';
$routing -> checkPageBD();
require_once 'view/footer.php';



?>