<section class="catalog">

<?php 
include 'left_sidebar.php';
include './class/class_products.php';

$products = new Products;
$products->getProductsDB();


?> 

<?php if ($_GET['category'] != '') {
    $prod_cat = $_GET['category'];?> 
    
<div class="products">
    <?php foreach ($products->Prod_cat($prod_cat) as $key => $value) { ?>
        <div class="item">
            <div class="item_logo"><a href="#"><img src="../img/<?php echo $value['img'];?>" alt="home"></a></div>
            <div class="item_price">
                <p class="price"><?php echo $value['price'];?> грн</p>
            </div>
            <p class="name"><?php echo $value['name'];?></p>
            <div class="item_info">
                <div class="info"><a href="view_product?product=<?php echo $value['id'];?>">Просмотр</a></div>
                <div class="cart"><a href="#">В корзину</a></div>
            </div> 
        </div>
    <?php } ?>          
</div>
    
<?php } else {?> 

<div class="products">
    <?php foreach ($products->getProductsDB() as $key => $value) { ?>
        <div class="item">
            <div class="item_logo"><a href="#"><img src="../img/<?php echo $value['img'];?>" alt="home"></a></div>
            <div class="item_price">
                <p class="price"><?php echo $value['price'];?> грн</p>
            </div>
            <p class="name"><?php echo $value['name'];?></p>
            <div class="item_info">
                <div class="info"><a href="view_product?product=<?php echo $value['id'];?>">Просмотр</a></div>
                <div class="cart"><a href="#">В корзину</a></div>
            </div> 
        </div>
    <?php } ?>          
</div>
<?php } ?> 

</section>

