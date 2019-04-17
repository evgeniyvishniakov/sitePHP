<?php 
require_once 'class/routing.php';

foreach ($rout as $routs => $file) {

    if ($routs == $page ) {
        $check = true;
        include_once $file . ".php";
    }
}

if ($check == false) {
    include_once 'views/404.php';
}

include_once 'views/head.php';
include_once 'views/header.php';








?>



     
        

