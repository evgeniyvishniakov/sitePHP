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
        <div class="sing">
            <h3>Sing in</h3>
            <p id="login">Login: Evgeniu; Password: 1234567896321</p>
            <p class="error"></p>
            <form action="" method="POST">
                <input class="login" type="text" name="login_auth" placeholder="Your login.." value="<?php echo $_POST['login_sing'];?>">
                <p class="error"></p>
                <input class="pass" type="password" name="pass_auth" placeholder="Your password.." value="<?php echo $_POST['pass_sing'];?>">
                <p class="error"></p>
                <input class="sing_sub" type="submit" name="sub_auth" value="sing in">
                <?php if($_POST['sub_auth']){ $this->checkAuth(); } ?>
            </form>
        </div>
    </div>
</section>

<?php
include 'include/footer.php';
?>

