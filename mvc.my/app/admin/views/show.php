<?php

include 'include/header.php';

?>
    <!--/боковое меню-->
    <div class="vg-main vg-right vg-relative">
        <div class="vg-wrap vg-firm-background-color1 vg-center vg-block vg-menu">
            <?php foreach($this->model_show->getTable() as $value => $name ){ ?>
                <a href="show?table=<?=$name['TABLE_NAME']?>" class="vg-wrap vg-element vg-full vg-center <?php if( $this->name_table === $name['TABLE_NAME']) echo 'active'; ?>">
                    <div class="vg-element vg-half  vg-center">
                        <div>
                            <img src="../app/admin/views/img/pages.png" alt="pages">
                        </div>
                    </div>
                    <div class="vg-element vg-half vg-center vg_hidden">
                        <span class="vg-text vg-firm-color5"><?=$name['TABLE_NAME']?></span>
                    </div>
                </a>
            <?php }; ?>
        </div>
        <div class="vg-wrap vg-element vg-ninteen-of-twenty">
            <div class="vg-element vg-fourth">
                <? if($_GET['table'] === 'tires' || $_GET['table'] === 'register'){?>
                <a href="add?table=<?=$this->name_table?>" class="vg-wrap vg-element vg-full vg-firm-background-color3 vg-box-shadow">
                <? }else{ ?>
                <a href="addatribute?table=<?=$this->name_table?>" class="vg-wrap vg-element vg-full vg-firm-background-color3 vg-box-shadow">
                <? } ?>
                    <div class="vg-element vg-half vg-center">
                        <img src="../app/admin/views/img/plus.png" alt="plus">
                    </div>
                    <div class="vg-element vg-half vg-center vg-firm-background-color1">
                        <span class="vg-text vg-firm-color3">Add</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="main_table_prod">

            <?php
                if ($this->name_table === 'tires'){
                    foreach($this->model_show->getListProducts($this->name_table) as $value => $name ){?>
                          <ul>
                              <li><p><a href="edit?id=<?=$name['id']?>"><?=$name['name']?></a></p></li>
                              <li><p class="stock"><?=$name['article']?></p></li>
                              <li><p class="stock"><? if($name['stock'] === 1) echo 'В наличии'; else echo 'нет в наличии';?></p></li>
                              <li><p class="stock"><?=$name['price']?></p></li>
                              <li><p class="stock"><?=$name['data']?></p></li>
                          </ul>
                <?php }
                 }elseif($this->name_table === 'register'){
                    foreach($this->model_show->getListProducts($this->name_table) as $value => $name ){ ?>
                          <ul>
                              <li><p><a href="#"><?=$name['login']?></a></p></li>
                              <li><p class="stock"><?=$name['email']?></p></li>
                          </ul>
                <?php }
                    }else{
                        foreach($this->model_show->getListProducts($this->name_table) as $value => $name ){ ?>
                            <ul>
                                <li><p><a href="edit?id=<?=$name['id']?>"><?=$name[$this->name_table . '_value']?></a></p></li>
                            </ul>
                        <?php
                         }
                    }   ?>
    </div>

<?php

include 'include/footer.php';
