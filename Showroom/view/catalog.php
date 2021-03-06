<?php

include_once './class/class_categories.php';
include_once './class/class_products.php';
include_once './class/class_filter.php';
include_once './class/class_filter_atribute.php';
include_once './class/class_filter.php';
include_once './class/class_pagination.php';


$categories = new Categories; // вывод категорий
$produsts = new Products; // вывод всех продуктов 

$atribure = new Filter_Atribute; // вывод список атрибутов

$nomberPage = $_GET['pagination'];

if (isset($nomberPage)) {
    $nomberPage = $_GET['pagination'];
}else {
    $nomberPage = 1;
}

$filter = new Filter($nomberPage); // класс для фильров

$filter->filter_parents_cat($_POST);
$filter->filter_child_cat($_POST);
$filter->filter_brand($_POST);  // НУЖНО МАССИВ ПЕРЕДАТЬ В КОНСТРУКТОР Filter
$filter->filter_size($_POST);
$filter->filter_price($_POST);
$filter->filter_color($_POST);



echo '<pre>';
var_dump($filter->NumberPages());
echo '</pre>';


				
?>


<section class="catalog">
  <div class="catalog_top_logo">
    <p>Catalog <span>view</span></p>
    <img src="img/catalog_top_logo.jpg" alt="">   
  </div>
  <div class="catalog_sidebar">
    <div class="left_sidebar">
	
		<form action="#" method="POST">
		
				<!-- РОДИТЕЛЬСКИЕ КАТЕГОРИИ  -->
				
			<div class="left_sidebar_categories">
				<p>Категории</p>
					<ol>

						<?php foreach ($atribure->brand_parents_categories() as $key => $value) { ?>
							<p><input type="checkbox" name="Parents_cat[]" value="<?php echo $value['name']; ?>"><label><?php echo $value['name']; ?></label></p>
						<?php } ?>
		
					</ol>
            </div>
			
				<!-- ДОЧЕРНИЕ КАТЕГОРИИ  -->
				
			<div class="left_sidebar_categories">
					<ol>

						<?php foreach ($atribure->brand_child_categories() as $key => $value) { ?>
							<p><input type="checkbox" name="Child_cat[]" value="<?php echo $value['name']; ?>"><?php echo $value['name']; ?></p>
						<?php } ?>
		
					</ol>
            </div>
        
				<!-- БРЕНД  -->
				
            <div class="left_sidebar_brand">
				<p>Бренд</p>
					<ol>

						<?php foreach ($atribure->brand_atribute() as $key => $value) { ?>
							<p><input type="checkbox" name="Brand[]" value="<?php echo $value['name']; ?>"><?php echo $value['name']; ?></p>
						<?php } ?>
		
					</ol>
            </div>

                <!-- ЦЕНА  -->

            <div class="left_sidebar_price">
                <p>Цена</p>
                    <p><input type="radio" name="Price" value="0 and 500">до 500 грн</p>
                    <p><input type="radio" name="Price" value="500 and 1000">от 501 грн до 1000 грн</p>
                    <p><input type="radio" name="Price" value="1000 and 1500">от 1001 грн до 1500 грн</p>
            </div>
        
                <!-- РАЗМЕР  -->
        
            <div class="left_sidebar_size">
                <p>Размер</p>
                <ol>

                    <?php foreach ($atribure->size_atribute() as $key => $value) { ?>
                        <p><input type="checkbox" name="Size[]" value="<?php echo $value['name']; ?>"><?php echo $value['name']; ?></p>
                    <?php } ?>
    
                </ol>
            </div>
            
                <!-- ЦВЕТ  -->
            
            <div class="left_sidebar_color">
                <p>Цвет</p>
                <div class="color_check">
                    <label class="checkbox-transform">
                        <input type="checkbox" name="Color[]" value="Красный" class="checkbox__input">  
                        <span class="checkbox__label"></span>
                    </label>
                    <label class="checkbox-transform">
                        <input type="checkbox" name="Color[]" value="Зеленый" class="checkbox__input">  
                        <span class="checkbox__label_green"></span>
                    </label>
                    <label class="checkbox-transform">
                        <input type="checkbox" name="Color[]" value="Желтый" class="checkbox__input">  
                        <span class="checkbox__label_yellow"></span>
                    </label>
                    <label class="checkbox-transform">
                        <input type="checkbox" name="Color[]" value="Синий" class="checkbox__input">  
                        <span class="checkbox__label_blue"></span>
                    </label>
                    <label class="checkbox-transform">
                        <input type="checkbox" name="Color[]" value="Коричневый" class="checkbox__input">  
                        <span class="checkbox__label_brown"></span>
                    </label>
                    <label class="checkbox-transform">
                        <input type="checkbox" name="Color[]" value="Фиолетовый" class="checkbox__input">  
                        <span class="checkbox__label_violet"></span>
                    </label>
                </div>    
            </div>
            
            <input class="filter_btn" type="submit" value="Применить фильтр" name="filter_ok">
			
        </form>  

    </div>
	
			<!-- ПРАВЫЙ САЙДБАР  -->
    <div class="right_sidebar">
        <div class="catalog_products">
            <div class="row">
            		
                <?php if (!empty($_POST['filter_ok'])) {  // если нажата фильтр выводим отфильрованые товары!  ?>  
                
					<?php foreach ($filter->filterBD() as $key => $value) { ?> 
						<div class="item">
							<p class="price"><sup>£</sup><?php echo $value['price'] ?></p>
							<a class="view" href="#"><i class="fa fa-info"></i></a>
							<a href="#"><img src="img/<?php echo $value['foto'] ?>" alt="<?php echo $value['foto'] ?>"></a>
							<div class="description">
								<p class="name"><?php echo $value['name'] ?> <span><?php echo $value['price'] ?>£</span></p>
								<p class="desc">Classic casual t-shirt for women on the move.</p>
								<p class="comp">100% cotton.</p>
								<div class="icon">
									<form action="#" mathod="post">
										<button type="submit"><i class="fa fa-shopping-cart"></i></button>
										<button type="submit"><i class="fa fa-heart-o"></i></button>
										<button type="submit"><i class="fa fa-compress"></i></button>
									</form>
								</div>
							</div>    
						</div> 
					<?php } ?>
					
					<?php if (!$filter->filterBD()) { // если товаров нет 

						echo 'Товары не найдены, <a href="catalog"> вернуться к списку?</a>';
						
						}
					?> 
					
				<?php } else { // в противном случаи выводим все товары ?>
						   
					<?php foreach ($filter->filterBD() as $key => $value) { ?> 
						<div class="item">
							<p class="price"><sup>£</sup><?php echo $value['price'] ?></p>
							<a class="view" href="#"><i class="fa fa-info"></i></a>
							<a href="#"><img src="img/<?php echo $value['foto'] ?>" alt="<?php echo $value['foto'] ?>"></a>
							<div class="description">
								<p class="name"><?php echo $value['name'] ?> <span><?php echo $value['price'] ?>£</span></p>
								<p class="desc">Classic casual t-shirt for women on the move.</p>
								<p class="comp">100% cotton.</p>
								<div class="icon">
									<form action="#" mathod="post">
										<button type="submit"><i class="fa fa-shopping-cart"></i></button>
										<button type="submit"><i class="fa fa-heart-o"></i></button>
										<button type="submit"><i class="fa fa-compress"></i></button>
									</form>
								</div>
							</div>    
						</div> 
					<?php } ?> 
				<?php } ?> 
              
            </div>    
        </div>
		
			<!-- ПАГИНАЦИЯ  -->
		
        <div class="pagination">
            <ul>
                <li><a href="#"><i class="fa fa-angle-left"></i></a></li>
                <li><a href="?pagination=1">1</a></li>
                <li><a href="?pagination=2">2</a></li>
                <li><a href="?pagination=3">3</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
            </ul>
        </div>
    </div>
</div> 
</section>