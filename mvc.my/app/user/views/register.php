<?php
include 'include/head.php';
include 'include/header.php';
?>

<section class="sing_in">
    <div class="sing_in_top_logo">
        <p>Welcome <span>to ave</span></p>
        <img src="img/catalog_top_logo.jpg" alt="">   
    </div>
    <div class="sing_reg">
        <div class="register">
            <h3>Register</h3>
            <p class="error"></p>
            <form action="" method="POST">
                <input class="login"  type="text"  name="login" placeholder="Your login.. (не меньше 6 символов)" value="<?php echo $_POST['login'];?>">

                <input class="mail" type="text" name="email" placeholder="Your email.." value="<?php echo $_POST['email'];?>">

                <input class="pass"  type="password" name="pass" placeholder="Your password.. (не меньше 12 символов)" value="<?php echo $_POST['pass'];?>">

                <label><input name="check_reg" type="checkbox" > Sign up for exclusive updates, discounts, new arrivals, contests, and more!</label>
                <input  class="reg_sub" type="submit" name="reg_ok" value="Зарегистрироваться">

				<?php if($_POST['check_reg'] && $_POST['reg_ok']){ $this->register(); } ?>
            </form>
        </div>      
    </div>
</section>
<?php
include 'include/footer.php';
?>

