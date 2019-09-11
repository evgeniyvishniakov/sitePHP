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
<form id="form1" class="vg-wrap vg-element vg-ninteen-of-twenty" method="post" action=""
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
                            <span class="vg-header">Название</span>
                        </div>
                        <div class="vg-element vg-full vg-left">
                            <span class="vg-text vg-firm-color5"></span><span class="vg_subheader"></span>
                        </div>
                    </div>
                    <div class="vg-element vg-full">
                        <div class="vg-element vg-full vg-left ">
                            <input type="text" name="name" class="vg-input vg-text vg-firm-color1"
                                   value="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="vg-element vg-full vg-box-shadow">
                <div class="vg-wrap vg-element vg-full vg-box-shadow">
                    <div class="vg-wrap vg-element vg-full">
                        <div class="vg-element vg-full vg-left">
                            <span class="vg-header">Артикул</span>
                        </div>
                        <div class="vg-element vg-full vg-left">
                            <span class="vg-text vg-firm-color5"></span><span class="vg_subheader"></span>
                        </div>
                    </div>
                    <div class="vg-element vg-full">
                        <div class="vg-element vg-full vg-left ">
                            <input type="number" name="article" class="vg-input vg-text vg-firm-color1"
                                   value="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="vg-element vg-full vg-box-shadow">
                <div class="vg-wrap vg-element vg-full vg-box-shadow">
                    <div class="vg-element vg-full vg-left">
                        <span class="vg-header">Бренд</span>
                    </div>
                    <div class="select-wrapper vg-element vg-full vg-left vg-no-offset">
                        <div class="select-arrow-3 select-arrow-31"></div>
                        <select name="brands_id" class="vg-input vg-text vg-full vg-firm-color1">
                            <option value="" selected>
                                Выбрать
                            </option>
                            <? foreach ($this->model_atribute->get('brands') as $value => $key){ ?>

                                <option value="<?=$key['id'];?>">
                                    <?=$key['brands_value'];?>
                                </option>

                            <? } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="vg-element vg-full vg-box-shadow">
                <div class="vg-wrap vg-element vg-full vg-box-shadow">
                    <div class="vg-element vg-full vg-left">
                        <span class="vg-header">Родительская категория</span>
                    </div>
                    <div class="select-wrapper vg-element vg-full vg-left vg-no-offset">
                        <div class="select-arrow-3 select-arrow-31"></div>
                        <select name="categories_id" class="vg-input vg-text vg-full vg-firm-color1">
                            <option value="" selected>
                                Выбрать
                            </option>
                            <? foreach ($this->model_atribute->get('categories') as $value => $key){ ?>

                                <option value="<?=$key['id'];?>">
                                    <?=$key['categories_value'];?>
                                </option>

                            <? } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="vg-element vg-full vg-box-shadow">
                <div class="vg-wrap vg-element vg-full vg-box-shadow">
                    <div class="vg-element vg-full vg-left">
                        <span class="vg-header">Ширина</span>
                    </div>
                    <div class="select-wrapper vg-element vg-full vg-left vg-no-offset">
                        <div class="select-arrow-3 select-arrow-31"></div>
                        <select name="width_id" class="vg-input vg-text vg-full vg-firm-color1">
                            <option value="" selected>
                                Выбрать
                            </option>
                            <? foreach ($this->model_atribute->get('width') as $value => $key){ ?>

                                <option value="<?=$key['id'];?>">
                                    <?=$key['width_value'];?>
                                </option>

                            <? } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="vg-element vg-full vg-box-shadow">
                <div class="vg-wrap vg-element vg-full vg-box-shadow">
                    <div class="vg-element vg-full vg-left">
                        <span class="vg-header">Высота</span>
                    </div>
                    <div class="select-wrapper vg-element vg-full vg-left vg-no-offset">
                        <div class="select-arrow-3 select-arrow-31"></div>
                        <select name="height_id" class="vg-input vg-text vg-full vg-firm-color1">
                            <option value="" selected>
                                Выбрать
                            </option>
                            <? foreach ($this->model_atribute->get('height') as $value => $key){ ?>

                                <option value="<?=$key['id'];?>">
                                    <?=$key['height_value'];?>
                                </option>

                            <? } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="vg-element vg-full vg-box-shadow">
                <div class="vg-wrap vg-element vg-full vg-box-shadow">
                    <div class="vg-element vg-full vg-left">
                        <span class="vg-header">Диаметр</span>
                    </div>
                    <div class="select-wrapper vg-element vg-full vg-left vg-no-offset">
                        <div class="select-arrow-3 select-arrow-31"></div>
                        <select name="diameter_id" class="vg-input vg-text vg-full vg-firm-color1">
                            <option value="" selected>
                                Выбрать
                            </option>
                            <? foreach ($this->model_atribute->get('diameter') as $value => $key){ ?>

                                <option value="<?=$key['id'];?>">
                                    <?=$key['diameter_value'];?>
                                </option>
                            <? } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="vg-element vg-full vg-box-shadow">
                <div class="vg-wrap vg-element vg-full vg-box-shadow">
                    <div class="vg-wrap vg-element vg-full">
                        <div class="vg-element vg-full vg-left">
                            <span class="vg-header">Цена</span>
                        </div>
                        <div class="vg-element vg-full vg-left">
                            <span class="vg-text vg-firm-color5"></span><span class="vg_subheader"></span>
                        </div>
                    </div>
                    <div class="vg-element vg-full">
                        <div class="vg-element vg-full vg-left ">
                            <input type="number" name="price" class="vg-input vg-text vg-firm-color1"
                                   value="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="vg-element vg-full vg-box-shadow">
                <div class="vg-wrap vg-element vg-full vg-box-shadow">
                    <div class="vg-wrap vg-element vg-full">
                        <div class="vg-element vg-full vg-left">
                            <span class="vg-header">Скидка</span>
                        </div>
                        <div class="vg-element vg-full vg-left">
                            <span class="vg-text vg-firm-color5"></span><span class="vg_subheader"></span>
                        </div>
                    </div>
                    <div class="vg-element vg-full">
                        <div class="vg-element vg-full vg-left ">
                            <input type="number" name="sale" class="vg-input vg-text vg-firm-color1"
                                   value="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="vg-wrap vg-element vg-img">
        <div class="vg-full vg-firm-background-color4 vg-box-shadow">
            <div class="vg-element vg-full vg-box-shadow">
                <div class="vg-element vg-full vg-box-shadow">
                    <div class="vg-wrap vg-element vg-half vg-left vg-no-space-top">
                        <div class="vg-element vg-full vg-left">
                            <span class="vg-header">Видимость</span>
                        </div>
                        <div class="vg-wrap vg-element vg-fourth">
                            <label class="vg-element vg-full vg-center vg-left vg-space-between">
                                <input type="radio" name="visible" class="vg-input vg-half" value="0">
                                <span class="vg-text vg-half">Нет</span>
                            </label>
                            <label class="vg-element vg-full vg-center vg-left vg-space-between">
                                <input type="radio" name="visible" class="vg-input vg-half" checked value="1">
                                <span class="vg-text vg-half">Да</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="vg-element vg-full vg-box-shadow">
                <div class="vg-element vg-full vg-box-shadow">
                    <div class="vg-wrap vg-element vg-half vg-left vg-no-space-top">
                        <div class="vg-element vg-full vg-left">
                            <span class="vg-header">Сезон</span>
                        </div>
                        <div class="vg-wrap vg-element vg-fourth">
                            <label class="vg-element vg-full vg-center vg-left vg-space-between">
                                <input type="radio" name="season_id" class="vg-input vg-half" value="0">
                                <span class="vg-text vg-half">Зима</span>
                            </label>
                            <label class="vg-element vg-full vg-center vg-left vg-space-between">
                                <input type="radio" name="season_id" class="vg-input vg-half" checked value="1">
                                <span class="vg-text vg-half">Лето</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="vg-element vg-full vg-box-shadow">
                <div class="vg-element vg-full vg-box-shadow">
                    <div class="vg-wrap vg-element vg-half vg-left vg-no-space-top">
                        <div class="vg-element vg-full vg-left">
                            <span class="vg-header">Наличие</span>
                        </div>
                        <div class="vg-wrap vg-element vg-fourth">
                            <label class="vg-element vg-full vg-center vg-left vg-space-between">
                                <input type="radio" name="stock" class="vg-input vg-half" value="1">
                                <span class="vg-text vg-half">В наличии</span>
                            </label>
                            <label class="vg-element vg-full vg-center vg-left vg-space-between">
                                <input type="radio" name="stock" class="vg-input vg-half" checked value="0">
                                <span class="vg-text vg-half">Нет в наличии</span>

                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="vg-wrap vg-element vg-full vg-box-shadow img_container img_wrapper">
                <div class="vg-wrap vg-element vg-half">
                    <div class="vg-wrap vg-element vg-full">
                        <div class="vg-element vg-full vg-left">
                            <span class="vg-header">Изображение</span>
                        </div>
                        <div class="vg-element vg-full vg-left">
                            <span class="vg-text vg-firm-color5"></span><span class="vg_subheader"></span>
                        </div>
                    </div>
                    <div class="vg-wrap vg-element vg-full">
                        <label for="img" class="vg-wrap vg-full file_upload vg-left">
                            <span class="vg-element vg-full vg-input vg-text vg-left vg-button" style="float: left; margin-right: 10px">Выбрать</span>
                            <a style="color:black;" href=""
                                class="vg-element vg-full vg-input vg-text vg-left vg-button vg_delete">
                                <span>Удалить</span>
                            </a>
                            <input id="img" type="file" name="foto" class="single_img inputFile">
                        </label>
                    </div>
                    <div class="vg-wrap vg-element vg-full">
                        <div class="vg-element vg-left img_show main_img_show">
                            <img src="" id="image_upload_preview" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="vg-element vg-full vg-box-shadow img_wrapper">
                <div class="vg-wrap vg-element vg-full">
                    <div class="vg-wrap vg-element vg-full">
                        <div class="vg-element vg-full vg-left">
                            <span class="vg-header">Галерея</span>
                        </div>
                        <div class="vg-element vg-full vg-left">
                            <span class="vg-text vg-firm-color5"></span><span class="vg_subheader"></span>
                        </div>
                    </div>
                    <div class="vg-wrap vg-element vg-full gallery_container" id="list">
                        <label class="vg-dotted-square vg-center">
                            <img src="../app/admin/views/img/plus.png" alt="plus">
                            <input class="gallery_img" style="display: none;" type="file" id="files" name="files[]"  multiple>
                        </label>
                        <span>
                            <div class="vg-dotted-square vg-center" >
                                <img class="vg_delete" src="">
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="vg-wrap vg-element vg-content">
        <div class="vg-wrap vg-element vg-full vg-firm-background-color4 vg-box-shadow">
            <div class="vg-wrap vg-element vg-full vg-box-shadow">
                <div class="vg-wrap vg-element vg-full">
                    <div class="vg-element vg-full vg-left">
                        <span class="vg-header">Описание</span>
                    </div>
                    <div class="vg-element vg-full vg-left">
                        <span class="vg-text vg-firm-color5"></span><span class="vg_subheader"></span>
                    </div>
                </div>
                <div class="vg-element vg-full vg-left">
                    <textarea name="content" class="vg-input vg-text vg-full vg-firm-color1"></textarea>
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
                            <?php if($_POST['save'] && $this->addProduct()) echo '<div class="success">Товар добавлен</div>'; ?>
                </div>
                <div class="vg-element vg-padding-in-px">
                    <input type="submit" name="delete" class="vg-text vg-firm-color1 vg-firm-background-color4 vg-input vg-button" value="Удалить">
                </div>
            </div>
        </div>
    </div>
</form>
<?php


include 'include/footer.php';


?>
