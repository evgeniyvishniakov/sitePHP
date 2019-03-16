<?php 
include_once './class/class__auth.php';

    if (!empty($_POST['login']) AND !empty($_POST['password']) AND !empty($_POST['submit'])){
        $login = $_POST['login'];
        $password = $_POST['password'];

        $auth = new Authentication($login, $password);
            if ($auth->addAuth()){
                $_SESSION['user'] = 1;
                header("location: http://registerphp/"); 
            }
    } 
?>
<div class="authentication">
    <h3> Авторизация</h3> 
    <div class="line"></div>
    
    <div class="form">
        <div class="form_auth">
            <p>Введите данные</p>
            <form action="" method="POST">
                <label>Логин:</label><br>
                <input type="text" name='login'><br><br>
                <label>Пароль:</label><br>
                <input type="password" name="password"><br><br>
                <input type="submit" name="submit" value="Авторизироваться">
            </form>
        </div>
    </div>

</div>