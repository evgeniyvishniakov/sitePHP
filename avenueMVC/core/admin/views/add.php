<form class="vg-wrap vg-element vg-ninteen-of-twenty" method="post" action="/admin/shop/edit"
      enctype="multipart/form-data">
    <div class="vg-wrap vg-element vg-full">
        <div class="vg-wrap vg-element vg-full vg-firm-background-color4 vg-box-shadow">
            <div class="vg-element vg-half vg-left">
                <div class="vg-element vg-padding-in-px">
                    <input type="submit" class="vg-text vg-firm-color1 vg-firm-background-color4 vg-input vg-button" value="Сохранить">
                </div>
                <div class="vg-element vg-padding-in-px">
                    <a href=""
                       class="vg-text vg-firm-color1 vg-firm-background-color4 vg-input vg-button vg-center vg_delete">
                        <span>Удалить</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="id" value="1">
    <input type="hidden" name="table" value="shop_products">

    <div class="vg-wrap vg-element vg-rows">
        <div class="vg-full vg-firm-background-color4 vg-box-shadow">
            <div class="vg-element vg-full vg-box-shadow">
                <div class="vg-wrap vg-element vg-full vg-box-shadow">
                    <div class="vg-wrap vg-element vg-full">
                        <div class="vg-element vg-full vg-left">
                            <span class="vg-header">name</span>
                        </div>
                        <div class="vg-element vg-full vg-left">
                            <span class="vg-text vg-firm-color5"></span><span class="vg_subheader"></span>
                        </div>
                    </div>
                    <div class="vg-element vg-full">
                        <div class="vg-element vg-full vg-left ">
                            <input type="text" name="name" class="vg-input vg-text vg-firm-color1"
                                   value="name value">
                        </div>
                    </div>
                </div>
            </div>
            <div class="vg-wrap vg-element vg-full vg-box-shadow">
                <div class="vg-wrap vg-element vg-full vg-box-shadow">
                    <div class="vg-wrap vg-element vg-full">
                        <div class="vg-element vg-full vg-left">
                            <span class="vg-header">keywords</span>
                        </div>
                        <div class="vg-element vg-full vg-left">
                            <span class="vg-text vg-firm-color5">Max 70 chars</span><span class="vg_subheader"></span>
                        </div>
                    </div>
                    <div class="vg-element vg-full">
                        <div class="vg-element vg-full vg-left">
                            <textarea name="keywords" class="vg-input vg-text vg-full vg-firm-color1">1</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="vg-element vg-full vg-box-shadow">
                <div class="vg-element vg-full vg-box-shadow">
                    <div class="vg-wrap vg-element vg-half vg-left vg-no-space-top">
                        <div class="vg-element vg-full vg-left">
                            <span class="vg-header">visible</span>
                        </div>
                        <div class="vg-wrap vg-element vg-fourth">
                            <label class="vg-element vg-full vg-center vg-left vg-space-between">
                                <span class="vg-text vg-half">No</span>
                                <input type="radio" name="visible" class="vg-input vg-half" value="0">
                            </label>
                            <label class="vg-element vg-full vg-center vg-left vg-space-between">
                                <span class="vg-text vg-half">Yes</span>
                                <input type="radio" name="visible" class="vg-input vg-half" checked value="1">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="vg-element vg-full vg-box-shadow">
                <div class="vg-wrap vg-element vg-full vg-box-shadow">
                    <div class="vg-element vg-full vg-left">
                        <span class="vg-header">menu_position</span>
                    </div>
                    <div class="select-wrapper vg-element vg-full vg-left vg-no-offset">
                        <div class="select-arrow-3 select-arrow-31"></div>
                        <select name="menu_position" class="vg-input vg-text vg-full vg-firm-color1">
                            <option value="1" selected>
                                1
                            </option>
                            <option value="2">
                                2
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="vg-element vg-full vg-box-shadow">
                <div class="vg-wrap vg-element vg-full vg-box-shadow">
                    <div class="vg-element vg-full vg-left">
                        <span class="vg-header">parent_id</span>
                    </div>
                    <div class="select-wrapper vg-element vg-full vg-left vg-no-offset">
                        <div class="select-arrow-3 select-arrow-31"></div>
                        <select name="parent_id" class="vg-input vg-text vg-full vg-firm-color1">
                            <option value="17" selected>
                                parent 1
                            </option>
                            <option value="21">
                                parent 2
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="vg-wrap vg-element vg-img">
        <div class="vg-full vg-firm-background-color4 vg-box-shadow">
            <div class="vg-wrap vg-element vg-full vg-box-shadow img_container img_wrapper">
                <div class="vg-wrap vg-element vg-half">
                    <div class="vg-wrap vg-element vg-full">
                        <div class="vg-element vg-full vg-left">
                            <span class="vg-header">img</span>
                        </div>
                        <div class="vg-element vg-full vg-left">
                            <span class="vg-text vg-firm-color5"></span><span class="vg_subheader"></span>
                        </div>
                    </div>
                    <div class="vg-wrap vg-element vg-full">
                        <label for="img" class="vg-wrap vg-full file_upload vg-left">
                            <span class="vg-element vg-full vg-input vg-text vg-left vg-button" style="float: left; margin-right: 10px">Выбрать</span>
                            <a style="color:black" href=""
                                class="vg-element vg-full vg-input vg-text vg-left vg-button vg_delete">
                                <span>Удалить</span>
                            </a>
                            <input id="img" type="file" name="img" class="single_img">
                        </label>
                    </div>
                    <div class="vg-wrap vg-element vg-full">
                        <div class="vg-element vg-left img_show main_img_show">
                            <img src="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="vg-element vg-full vg-box-shadow img_wrapper">
                <div class="vg-wrap vg-element vg-full">
                    <div class="vg-wrap vg-element vg-full">
                        <div class="vg-element vg-full vg-left">
                            <span class="vg-header">gallery_img</span>
                        </div>
                        <div class="vg-element vg-full vg-left">
                            <span class="vg-text vg-firm-color5"></span><span class="vg_subheader"></span>
                        </div>
                    </div>
                    <div class="vg-wrap vg-element vg-full gallery_container">
                        <label class="vg-dotted-square vg-center">
                            <img src="/core/admin/view/img/plus.png" alt="plus">
                            <input class="gallery_img" style="display: none;" type="file" name="gallery_img[]" multiple>
                        </label>
                        <div class="vg-dotted-square vg-center">
                            <img class="vg_delete" src="">
                        </div>
                        <div class="vg-dotted-square vg-center empty_container"></div>
                        <div class="vg-dotted-square vg-center empty_container"></div>
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
                        <span class="vg-header">content</span>
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
                    <input type="submit"
                           class="vg-text vg-firm-color1 vg-firm-background-color4 vg-input vg-button"
                           value="Сохранить">
                </div>
                <div class="vg-element vg-padding-in-px">
                    <a href="/admin/shop/delete/table/shop_products/id_row/id/id/92"
                       class="vg-text vg-firm-color1 vg-firm-background-color4 vg-input vg-button vg-center vg_delete">
                        <span>Удалить</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>

				