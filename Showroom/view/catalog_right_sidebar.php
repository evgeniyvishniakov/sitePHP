<?php 
include_once './class/class_filter.php';

$filter = new Filter;
?>


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

						echo 'Товары не найдены';
						
						}
					?> 
					
				<?php } else { // в противном случаи выводим все товары ?> ?>
						   
					<?php foreach ($produsts->products_list() as $key => $value) { ?> 
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