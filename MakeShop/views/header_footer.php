<?php 
include './class/class_categories_menu.php';

$categories = new CategoriesMenu;
$categories_menu = $categories->CategoriesMenuBD();


?>

<div class="header_footer">
        <div class="logo">
            <a href="http://registerphp/"><img src="./img/logo.jpg" alt="logo"></a>
        </div>
        <div class="header_footer_menu">
            <ul>
            <?php foreach ($categories_menu as $key_menu) { ?>
                <li><a href="?category=<?=$key_menu['id']?>"><?php echo $key_menu['name'];?></a></li>
            <?php } ?>    
            </ul>
        </div>
        <div class="search">
            <form action="" method="POST">
                <input type="search">
            </form>
        </div>   
</div>

