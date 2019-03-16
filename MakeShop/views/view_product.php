<?php

include './class/class_product_view.php';

$products_view = new ProductView;



if ($_GET['product'] != '') {
  $prod_view = $_GET['product'];
}else{
  header("location: http://registerphp/views/404.php"); 
} 


?> 

<div class="wiev_product">
<?php foreach ($products_view->Product_view($prod_view) as $key => $value) { ?>

  <div class="slider_product"><img src="../img/<?php echo $value['img'];?>"></div> 
  <div class="info_product">
  <?php } ?> 
  <p class="name"><?php echo $value['name'];?></p>
  <p class="info">Our company advocates the postulate that the health is the biggest value in our lives. The point is that science and nature are easily combined in products that we are glad to offer you today. Our goal is to help you stay healthy as well as gorgeous at the same time. Soon you’ll discover how it is possible to use organic cosmetics for your body.</p>
  </div>
  <div class="addcart_product">
    <div class="price"><p><?php echo $value['price'];?> грн</p></div>
    <div class="quantiti">https://foundation.zurb.com/</div>
    <div class="add_to_cart">
      <form action="" method="post">
        <input type="button" value="Добавить в корзину"/>
      </form>
    </div>
    <div class="add_to_like_list">
      <form action="" method="post">
        <input type="button" value="Добавить в избранное"/>
      </form>
      <div class="pay">
       <ul>
         <li><a href="#">PayPal</a></li>
         <li><a href="#">Visa</a></li>
         <li><a href="#">MasterCard</a></li>
         <li><a href="#">SSL</a></li>  
       </ul>
      </div> 
    </div>
  </div>
</div>