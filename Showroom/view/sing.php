<?php

include_once './class/class_auth.php';

         /* Авторизация */


    if (!empty($_POST['login_sing']) AND 
         !empty($_POST['pass_sing']) AND  
         !empty($_POST['sub_sing'])){ 
 
         $login = $_POST['login_sing'];
         $password = $_POST['pass_sing'];
 
         $sing = new Authentication($login, $password);
   
         if ($sing->checkRegisterBD() == false) {
            $error_pass_sing = 'Неверный пароль!';
         }
         if ($sing->Auth() == true) {
            $ok_sing = 'Вы вошли как ' . $login;
            $_SESSION['auth'] = 1; 
            
            header('Location: http://showroom/');
            ob_end_flush();
            exit;
            
         }else {
             $error_login_sing = 'Такого логина не существует или неверный пароль!';
         }   
     } 

            /* Регистрация */

    if (!empty($_POST['login_reg']) AND 
        !empty($_POST['pass_reg']) AND 
        !empty($_POST['email_reg']) AND 
        $_POST['check_reg'] == true AND 
        !empty($_POST['sub_reg'])){ 

        $login = $_POST['login_reg'];
        $password = $_POST['pass_reg'];
        $email = $_POST['email_reg'];

        $register = new CreaterAccount($login, $email, $password);
  
        if ($register->checkPassword() == false) {
           $error_pass_reg = 'Некоректно введен пароль, минимум 12 символов!';
        }
        if ($register->checkEmail() == false) {
            $error_email_reg = 'Некоректно введен email!';
        }
        if ($register->checkLogin() == false) {
           $error_login_reg = 'Некоректно введен логин, минимум 6 символов!';
        }
        if ($register->register() == true) {
            $ok_reg = 'Регистрация прошла успешно!';
        }else {
            $error_loginBD_reg = 'Такой логин уже существует';
        }    
    }   
    
?>


<section class="sing_in">
    <div class="sing_in_top_logo">
        <p>Welcome <span>to ave</span></p>
        <img src="img/catalog_top_logo.jpg" alt="">   
    </div>
    <div class="sing_reg">
        <div class="sing">
            <h3>Sing in</h3>
            <p class="error"><?php echo $ok_sing ?></p>
            <form action="" method="POST">
                <input class="login" type="text" name="login_sing" placeholder="Your login.." value="<?php echo $_POST['login_sing'];?>">
                <p class="error"><?php echo $error_login_sing ?></p>
                <input class="pass" type="password" name="pass_sing" placeholder="Your password.." value="<?php echo $_POST['pass_sing'];?>">
                <p class="error"><?php echo $error_pass_sing ?></p>
                <input class="sing_sub" type="submit" name="sub_sing" value="sing in">
            </form>
        </div>
        <div class="register">
            <h3>Register</h3>
            <p class="error"><?php echo $ok_reg ?></p>
            <form action="" method="POST">
                <input class="login" type="text" name="login_reg" placeholder="Your login.. (не меньше 6 символов)" value="<?php echo $_POST['login_reg'];?>">
                <p class="error">
                <?php echo $error_login_reg?>
                <?php echo $error_loginBD_reg?>
                </p>
                <input class="mail" type="text" name="email_reg" placeholder="Your email.." value="<?php echo $_POST['email_reg'];?>">
                <p class="error"><?php echo $error_email_reg ?></p>
                <input class="pass" type="password" name="pass_reg" placeholder="Your password.. (не меньше 12 символов)" value="<?php echo $_POST['pass_reg'];?>">
                <p class="error"><?php echo $error_pass_reg ?></p>
                <label><input name="check_reg" type="checkbox" > Sign up for exclusive updates, discounts, new arrivals, contests, and more!</label>
                <input class="reg_sub" type="submit" name="sub_reg" value="Create account">
            </form>
        </div>      
    </div>
</section>

