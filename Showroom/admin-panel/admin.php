<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="/css/admin/style_admin.css">
    <link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <title>Админ</title>
</head>
<body>

<section class="admin">
    <div class="top_admin">
        <div class="logo">
            <p>Admin</p>
        </div>
        <div class="logout">
            <p class="name">Имя пользователя</p>
            <a href="http://showroom/">Вернуться на сайт</a>
            <a href="">Выход</a>
        </div>
    </div>
    <div class="main_admin">
        <div class="left_admin">
            <ul>
            <a href="#">Главная</a>
            <a href="?get=products">Товары</a>
            <a href="#">Категории</a>
            <a href="#">Пользователи</a>
            <a href="?get=atribute">Атрибуты</a>
            
            </ul>
        </div>
        <div class="right_admin">
            <?php 
                $admin_page = [
                    "atribute" ,
                    "products" ,
                ];

                foreach ($admin_page as $page ) {
                   if ($page == $_GET['get']) {
                        require_once "view/admin_". $page .".php";
                   }
                }
            
            ?>
        </div>
    </div>
</section>   
</body>
</html>

