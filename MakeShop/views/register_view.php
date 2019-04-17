<?php 
include_once './class/class__register.php';
header("location: http://makeshop/index");

if (!empty($_POST['login']) AND !empty($_POST['password']) AND !empty($_POST['email']) AND !empty($_POST['submit'])){
     
   $login = $_POST['login'];
       $password = $_POST['password'];
        $email = $_POST['email'];

   $acc = new CreaterAccount($login,$email,$password);
      if ($acc->register()){
          header("location: http://registerphp/index");
      } 
}  

?>
<div class="registration">
    <h3>Регистрация</h3> 
    <div class="line"></div>

    <div class="form">
        <div class="form_reg">
            <p>Создать учетную запись</p>
            <form action="" method="POST">
                <label>Логин:</label><br>
                <input type="text" name='login'><br><br>
                <label>Пароль:</label><br>
                <input type="password" name="password"><br><br>
                <label>Почта:</label><br>
                <input type="text" name="email"><br><br>
                <input type="submit" name="submit" value="Создать учетную запись">
                <?php 
                    
                ?>
            </form>
        </div>
    </div>

</div>