<header>
    <div class="header_top">
            <div class="row">
                <div class="col-md-7 header_top_menu">
                    <ul>
                        <li><a href="contacts">Контакты</a></li>
                        <li><a href="catalog">Каталог</a></li>
                    </ul>
                </div>
                <div class="col-md-3 registr"> 
                    <div <?php if ($_SESSION['user'] == 1){echo 'class="active_reg auth"';}else{echo 'class="active_auth auth"';}?>>
                        <a href="auth">Вход</a>
                        <a href="register">Регистрация</a>
                    </div> 
                    <div <?php if ($_SESSION['user'] == 1){echo 'class="active_auth logout"';}else{echo 'class="active_reg loguot"';}?>>
                        <a href="views/admin.php">Админ панель</a> 
                        <a href="views/logout.php">Выход</a> 
                    </div>
                </div>
                <div class=" col-md-2 cart">
                    <a href="#">Карзина</a>
                </div>
            </div>  
    </div>
</header>
  