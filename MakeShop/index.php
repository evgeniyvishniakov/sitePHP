<?php
include_once 'class/class_routing.php';

$get = $_GET['page'];
$routing = new Routing($get);

include_once 'views/head_view.php';
include_once 'views/header.php';
include_once 'views/header_footer.php';
$routing->checkPageBD();
require_once 'views/footer.php';





?>