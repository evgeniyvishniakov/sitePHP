
<section class="header">
    <div class="header_top_background">
        <div class="header_top">
		
			<!-- Выбрать валюту   -->
		
            <div class="header_top_menu">
                
            </div>
			
			<!-- РЕГИСТРАЦИЯ АВТОРИРАЗИЯ АДМИНКА   -->
			
            <div class="header_top_reg">
                <ul <?php if($_SESSION['auth'] != 1) { echo 'class="active"';}else{echo 'class="active-none"';}?>>
                    <li><a href="/register">Register</a></li>
                    <li id="login"><a href="/login">Login</a></li>
                </ul>  
                <ul <?php if ($_SESSION['auth'] == 1) { echo 'class="active"';}else{echo 'class="active-none"';}?>>
                    <li><a href="/logout">Logout</a></li>
                    <li><a href="/admin">Admin</a></li>
                </ul>                  
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
                    <a href="catalog">Каталог</a>
                </li>
                <li>
                    <a href="?category=2">Шины</a> 
                </li>
                <li>
                    <a href="?category=2">Диски</a>                
                </li>
                <li>
                    <a href="?category=10">Услуги</a>
                </li>
				<li>
                    <a href="?category=10">Блог</a>
                </li>
            </ul>
			<form id="search" action="#" method="POST">
                <input class="search" type="text" name="search" placeholder="Search..">
                <button class="search_sub" type="submit" name="search_sub"><i class="fa fa-search"></i></button>
            </form>
        </div>
		<div class="header_bottom_cart">
			<div class="dropdown">
				<a href="#"><i class="fa fa-balance-scale"></i></a>
				<button class="btn dropdown-toggle" type="button" data-toggle="dropdown" >
					<a href="#"><i class="fa fa-shopping-basket"></i></a>
					<span class='col_cart_head'>0</span>
				</button>
				
			  <ul class="dropdown-menu">
				<h2>Ваш товар</h2>           
				  <table class="table table-striped">
					<thead>
					  <tr>
						<th>Firstname</th>
						<th>Lastname</th>
						<th>Email</th>
					  </tr>
					</thead>
					<tbody>
					  <tr>
						<td>John</td>
						<td>Doe</td>
						<td>john@example.com</td>
					  </tr>
					  <tr>
						<td>Mary</td>
						<td>Moe</td>
						<td>mary@example.com</td>
					  </tr>
					  <tr>
						<td>July</td>
						<td>Dooley</td>
						<td>july@example.com</td>
					  </tr>
					</tbody>
				  </table>
				<a href="#">Перейти в корзину</a>
				<a href="#">Быстрый заказ</a>
			  </ul>
			</div>
		</div>
    </div>	
</div>
    
</section>
