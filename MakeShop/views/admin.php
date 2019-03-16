<?php
include '../class/class_categoriesDel.php';
include '../class/class_categories_menu.php';
include '../class/class_categoriesAdd.php';
include '../admin/class/class_productsAdd.php';
include '../admin/class/class_productsDel.php';
include '../admin/class/class_productsView.php';



if (!empty($_GET['del'])){
    $delet = $_GET['del'];

    $categoriesDel = new CategoriesDel($delet);
    $categoriesDel->CategoriesDelet();

}elseif (!empty($_GET['del_prod'])){
        $delet = $_GET['del_prod'];
    
        $pruductsDel = new ProductsDel($delet);
        $pruductsDel->ProductsDelet();
} 


$categories = new CategoriesMenu;
$categories_menu = $categories->CategoriesAllBD();



if (!empty($_POST['cat']) AND !empty($_POST['name_cat']) AND !empty($_POST['ok'])){
    $parent_cat = $_POST['cat'];
    $child_cat = $_POST['name_cat'];
  
    $categories = new CategoriesAdd($parent_cat,$child_cat);
        if($categories->categoriesAdd()){

            header("location: http://registerphp/views/admin.php");
            ob_end_flush();
        } 
}



?>
<div class="admin">
    <div class="categories">
        <div class="tabel">
            <table border="1">
                <tr>
                    <th>id</th>
                    <th>Название категории</th>
                    <th>Родительская категория</th>
                    
                </tr>
                <?php foreach ($categories_menu as $key_menu) { ?>
                <tr>
                    <td><?php echo $key_menu['id']; ?></td>
                    <td><?php echo $key_menu['name']; ?></td>
                    <td><?php echo $key_menu['parents_cat']; ?></td>
                    <td><a href="?del=<?php echo $key_menu['id'];?>">Удалить</a></td>
                </tr>
                <?php } ?> 
            </table>
        </div> 
        <div class="add_cat"> 
            <h2>Добавление Категорий</h2>
            <form action="" method="POST">
            <p><select name = "cat"> <!-- Название передаем в пост, через который выводим валуе каждого елемента -->

                <option selected disabled>Выберите родительскую категорию!</option>
                <option value="100">Парфумерия</option>
                <option value="103">Косметика</option>
                <option value="106">Косметика для волос</option>

            </select></p>
            <p>Название подкатегории <input name='name_cat' type="text"></p>
            <p><input type="submit" value="Отправить" name="ok"></p>
            </form>
        </div>  
    </div>



<h2>Добавление товаров</h2>
<?php

if (!empty($_POST['parent_cat']) AND 
    !empty($_POST['name']) AND 
    !empty($_POST['price']) AND 
    !empty($_POST['Download'])AND 
    !empty($_FILES['image']['name'])){

    $cat = $_POST['parent_cat'];
    $name_prod = $_POST['name'];
    $price = $_POST['price'];
    $img = $_FILES['image']['name'];
        
        $productsAdd = new ProductsAdd($cat, $price, $img, $name_prod);
        $productsAdd->addProductsDB();
}
?>

<form enctype="multipart/form-data" method="post" action="">

        <p><select name = "parent_cat"> <!-- Название передаем в пост, через который выводим валуе каждого елемента -->   
            <option selected disabled>Выберите категорию!</option>
            <?php foreach ($categories->CategoriesParents() as $key => $value) {?>
            <option value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>
            <?php }?>
        </select></p>

Название товара: <input type="text" name="name"><br>
Цена: <input type="text" name="price"><br>
Picture: <input type="file" name="image" multiple accept="image/*,image/jpeg" /><br>
<input type="submit" name="Download" />
</form>


    <div class="products">
            <table border="1">
                <tr>
                    <th>id</th>
                    <th>Название</th>
                    <th>Цена</th>
                    <th>Родительская категория</th> 
                </tr>
                <?php 
                $productsView = new ProductsView;
                foreach($productsView->getProductsDB() as $key_product) { ?>
                <tr>
                    <td><?php echo $key_product['id']; ?></td>
                    <td><?php echo $key_product['name']; ?></td>
                    <td><?php echo $key_product['price']; ?></td>
                    <td><?php echo $key_product['parents_cat']; ?></td>
                    <td><a href="?del_prod=<?php echo $key_product['id'];?>">Удалить</a></td>
                </tr>
                <?php } ?> 
            </table>
    </div>    
</div>        