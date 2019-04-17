<?php 

$rout = [

    "index" => "index",
    "auth" => "views/auth",
    "register" => 'views/register_view'
];

$page = $_GET['page'];
$check = false;

if ($page == "") {
    $page = 'index.php';
    $check = true;
}
?>