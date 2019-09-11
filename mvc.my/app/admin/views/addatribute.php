<?php

include 'include/header.php';



?>
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
</div>
<form class="vg-wrap vg-element vg-ninteen-of-twenty" method="post" action=""
      enctype="multipart/form-data">
    <div class="vg-wrap vg-element vg-full">
        <div class="vg-wrap vg-element vg-full vg-firm-background-color4 vg-box-shadow">
            <div class="vg-element vg-half vg-left">
                <div class="vg-element vg-padding-in-px">
                    <input type="submit" name="save" class="vg-text vg-firm-color1 vg-firm-background-color4 vg-input vg-button" value="Сохранить">
                </div>
                <div class="vg-element vg-padding-in-px">
                    <input type="submit" name="delete" class="vg-text vg-firm-color1 vg-firm-background-color4 vg-input vg-button" value="Удалить">
                </div>
            </div>
        </div>
    </div>
    <div class="vg-wrap vg-element vg-rows">
        <div class="vg-full vg-firm-background-color4 vg-box-shadow">
            <div class="vg-element vg-full vg-box-shadow">
                <div class="vg-wrap vg-element vg-full vg-box-shadow">
                    <div class="vg-wrap vg-element vg-full">
                        <div class="vg-element vg-full vg-left">
                            <span class="vg-header">Сохранить значение <?=$_GET['table']?></span>
                        </div>
                        <div class="vg-element vg-full vg-left">
                            <span class="vg-text vg-firm-color5"></span><span class="vg_subheader"></span>
                        </div>
                    </div>
                    <div class="vg-element vg-full">
                        <div class="vg-element vg-full vg-left ">
                            <input type="text" name="<?=$_GET['table'] . '_value';?>" class="vg-input vg-text vg-firm-color1"
                                   value="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="vg-wrap vg-element vg-full">
                <div class="vg-wrap vg-element vg-full vg-firm-background-color4 vg-box-shadow">
                    <div class="vg-element vg-half vg-left">
                        <div class="vg-element vg-padding-in-px">
                            <input type="submit" name="save"
                                   class="vg-text vg-firm-color1 vg-firm-background-color4 vg-input vg-button"
                                   value="Сохранить">
                            <?php if($_POST['save'] && $this->addAtribute() == true){echo '<div class="success">Значение добавлено</div>';}?>
                        </div>
                        <div class="vg-element vg-padding-in-px">
                            <input type="submit" name="delete" class="vg-text vg-firm-color1 vg-firm-background-color4 vg-input vg-button" value="Удалить">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?php

include 'include/footer.php';


?>