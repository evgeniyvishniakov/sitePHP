<?php 
session_start();
ob_start();


$admin_page[] = ["name"=>"Главная", "url"=>"home"];
$admin_page[] = ["name"=>"Товары", "url"=>"products"];
$admin_page[] = ["name"=>"Категории", "url"=>"categories"];
$admin_page[] = ["name"=>"Пользователи", "url"=>"users"];
$admin_page[] = ["name"=>"Атрибуты", "url"=>"atributes"];

//echo '<pre>';
//var_dump($admin_page);
//echo '</pre>';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Админ</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="/css/admin/style_admin.css">
    <link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="/js/jquery-3.3.1.min.js"></script>  
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
    
    <div class="admin_nav_menu">
      <ul class ="menu_list">
      <?php  foreach ($admin_page as $name ) {?>
          <a <?php if ($_GET['admin-page'] == $name['url']) echo "class=active"; ?> href="?admin-page=<?php echo $name['url']; ?>"> <?php echo $name['name']; ?></a>
      <?php } ?>
      </ul>
    </div>
    <div class="main_admin">
  
            <?php                 
                
                  foreach ($admin_page as $name) {
                    if ($name['url'] == $_GET['admin-page']) {
                      require_once "view/admin_". $name['url'] .".php";    
                    }
                  }                                                         
                
            ?>

    </div>
</section> 
<script>
    
  
</script>

</body>
</html>

