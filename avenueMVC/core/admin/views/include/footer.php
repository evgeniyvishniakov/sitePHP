            </div><!--.vg-main.vg-right-->
        </div><!--.vg-carcass-->
            <div class="vg_model vg_center">

                <?php
                    if(isset($_SESSION['res']['answer'])){
                        echo $_SESSION['res']['answer'];
                        unset($_SESSION['res']);
                    }
                ?>

            </div>
    </body>
</html>