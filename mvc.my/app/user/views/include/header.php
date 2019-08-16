
<section class="header">
    <div class="header_top_background">
        <div class="header_top">
		
			<!-- Выбрать валюту   -->
		
            <div class="header_top_curr">
                <form action="" method="post">
				
                    <p>Сurrency : <select name="currency">
                        <option selected value="UAH">UAH</option>
                        <option value="USD">USD</option>
                        <option value="EUR">EUR</option>
                    </select></p>
					
                </form>
            </div>
			
			<!-- РЕГИСТРАЦИЯ АВТОРИРАЗИЯ АДМИНКА   -->
			
            <div class="header_top_reg">
                <ul <?php if($_SESSION['auth'] != 1) { echo 'class="active"';}else{echo 'class="active-none"';}?>>
                    <li><a href="/register">Register</a></li>
                    <li><a href="/login">Login</a></li>
                </ul>  
                <ul <?php if ($_SESSION['auth'] == 1) { echo 'class="active"';}else{echo 'class="active-none"';}?>>
                    <li><a href="/logout">Logout</a></li>
                    <li><a href="/admin">Admin</a></li>
                </ul>                  
            </div>
			
			<!-- КОРЗИНА   -->
			
            <div class="header_top_cart">
                <a href="#"><i class="fa fa-shopping-cart"></i><span>empty</span><i class="fa fa-angle-down"></i></a>
            </div>
			
        </div>
    </div>    
    <div class="header_bottom">
	
		<!-- ЛОГОТИП   -->
	
        <div class="header_bottom_logo">
            <a href="/"><img src="./app/user/views/img/logo.png" alt="logo"></a>
        </div>
		
		<!-- ВЕРХНЕЕ МЕНЮ   -->

        <div class="header_bottom_menu">
            <ul>
                <li>
                    <a href="catalog">Catalog</a>
                </li>
                <li>
                    <a href="?category=2">Mens<i class="fa fa-angle-down"></i></a>
                    <div class="drop">
                        <ul>
                        <?php// foreach ($cat->CategoriesChilds() as $key => $value) {?>
                            <li><a href="<?php// echo  $value['id']; ?>"><?php// echo  $value['name']; ?></a></li>
                        <?php// } ?>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="?category=2">Womens<i class="fa fa-angle-down"></i></a>
                    <div class="drop">
                        <ul>
                        <?php// foreach ($cat->CategoriesChilds() as $key => $value) {?>
                            <li><a href="<?php// echo  $value['id']; ?>"><?php// echo  $value['name']; ?></a></li>
                        <?php// } ?>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="?category=10">The brand</a>
                </li>
                <li>
                    <a href="?category=11">Local Stores</a>        
                </li>
                <li>
                    <a href="?category=14">Look Book</a>   
                </li>
            </ul>
        </div>
		
		<!-- ПОИСК   -->
		
        <div class="header_bottom_search">
            <form action="#" method="POST">
                <input class="search" type="text" name="search" placeholder="Search..">
                <button class="search_sub" type="submit" name="search_sub"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </div>
    
</section>
