<?php
include 'include/head.php';
include 'include/header.php';
?>

<section class="catalog">
    <div id="wrap">
        <div id="main">
            <div class="container bordAdm">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="sidebar-container">
                            <div class="sidebar-left">
                                <div class="podbor" id="podbor140">
                                    <div class="filter-name" data-toggle="collapse" data-target="#podbor-price">
                                        Цена
                                    </div>
                                    <div id="podbor-price" class="collapseDiv in">
                                        <div>
                                            <div class="pricebox">
                                                <input
                                                        id="podbor_slider" name="podbor_slider" type="text" class="slider hidden" value=""
                                                        data-slider-min="0"
                                                        data-slider-max="68370.00"
                                                        data-slider-step="5"
                                                        data-slider-value="[0,68370]"
                                                        data-slider-tooltip="hide"
                                                        data-slider-handle="square"
                                                />
                                            </div>
                                            <div class="row rowpad10">
                                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5"><input type="text" id="price_from hidden_minimum_price" name="pfrom" value="0" start_value="0" class="form-control slider"></div>
                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 price-minus">-</div>
                                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5"><input type="text" id="price_to hidden_maximum_price" name="pto" value="68370" start_value="68370" class="form-control slider"></div>
                                            </div>
                                            <div id="price_range"></div>
                                        </div>
                                    </div>


                                    <div class="filter-name" data-toggle="collapse" data-target="#podbor-season">
                                        Сезон
                                    </div>
                                    <div id="podbor-season" class="collapseDiv in">
                                        <div>
                                            <div class="row rowpad6">
                                                <? foreach ($this->getAtribute('season') as $value => $key){ ?>
                                                <div class="col-sm-12">
                                                    <div class="checkbox pull-left">
                                                        <label>
                                                            <input type="checkbox" name="season" value="<?=$key['id'];?>" class="noreload common_selector season">
                                                            <p><?=$key['season_value'];?></p>
                                                        </label>
                                                    </div>
                                                </div>
                                                <? } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div data-cms-tab-content="cms-tab-140" class="cms-tab-140__contents">
                                        <div class="podbor-tab__content__item active">
                                            <div class="filter-name" data-toggle="collapse" data-target="#podbor-w">
                                                Ширина
                                            </div>
                                            <div id="podbor-w" class="collapseDiv in">
                                                <div class="row rowpad10 overflow-auto">
                                                    <? foreach ($this->getAtribute('width') as $value => $key){ ?>
                                                        <div class="col-lg- col-md- col-sm-6 col-xs-12 ">
                                                            <label>
                                                                <div class="podbor__checkbox ">
                                                                    <input class=" common_selector width" type="checkbox" name="width[]" value=" <?=$key['id'];?>">
                                                                </div>
                                                                <?=$key['width_value'];?> <font>(1070)</font>
                                                            </label>
                                                        </div>
                                                    <? } ?>
                                                </div>
                                            </div>
                                            <div class="filter-name" data-toggle="collapse" data-target="#podbor-h">
                                                Высота
                                            </div>
                                            <div id="podbor-h" class="collapseDiv in">
                                                <div class="row rowpad10 overflow-auto">
                                                    <? foreach ($this->getAtribute('height') as $value => $key){ ?>
                                                        <div class="col-lg-6 col-md- col-sm-6 col-xs-12 ">
                                                            <label>
                                                                <div class="podbor__checkbox ">
                                                                    <input class="common_selector height" type="checkbox" name="height[]" value=" <?=$key['id'];?>">
                                                                </div>
                                                                <?=$key['height_value'];?> <font>(1070)</font>
                                                            </label>
                                                        </div>
                                                    <? } ?>
                                                </div>
                                            </div>
                                            <div class="filter-name" data-toggle="collapse" data-target="#podbor-r">
                                                Диаметр
                                            </div>
                                            <div id="podbor-r" class="collapseDiv in">
                                                <div class="row rowpad10 overflow-auto">
                                                    <? foreach ($this->getAtribute('diameter') as $value => $key){ ?>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                                                            <label>
                                                                <div class="podbor__checkbox ">
                                                                    <input class="common_selector diameter" type="checkbox" name="diameter" value=" <?=$key['id'];?>">
                                                                </div>
                                                                <?=$key['diameter_value'];?> <font>(1070)</font>
                                                            </label>
                                                        </div>
                                                    <? } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="podbor-tab__content__item"><!-- buauto --></div>
                                    </div>
                                    <div class="filter-name" data-toggle="collapse" data-target="#podbor-brand">
                                        Производитель
                                    </div>
                                    <div id="podbor-brand" class="collapseDiv in">
                                        <? foreach ($this->getAtribute('brands') as $value => $key){ ?>
                                            <div class="hiddenbrands overflow-auto">
                                                <label>
                                                    <div class="podbor__checkbox ">
                                                        <input class="common_selector brands" type="checkbox" name="brands[]" value=" <?=$key['id'];?>">
                                                    </div>
                                                    <?=$key['brands_value'];?> <font>(1070)</font>
                                                </label>
                                            </div>
                                        <? } ?>
                                    </div>
                                </div>

                                <!-- End block <b>#140 Podbor; time: 0.021394968032837</b> sec -->
                            </div>
                            <div class="sidebar-overlay"></div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                        <div class="sort-pager">
                            <div class="row rowpad10">
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                    <div class="sort-pager__sortable">
                                        <div class="sort-pager__sortable__sortby">
                                            Сортировать:
                                            <div class="btn-group">
                                                <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                                                    популярность
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a rel="nofollow" href="/shiny/name-asc/" >название</a></li>
                                                    <li><a rel="nofollow" href="/shiny/cena-asc/" >цена <i class="fa fa-arrow-up"></i></a></li>
                                                    <li><a rel="nofollow" href="/shiny/cena-desc/" >цена <i class="fa fa-arrow-down"></i></a></li>
                                                    <li><a rel="nofollow" href="/shiny/cntview-asc/" class="sel">популярность</a></li>
                                                    <li><a rel="nofollow" href="/shiny/dt-desc/" >дата поступления</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row rowpad14 auto-clear filter_data" id="allTovars">

                        </div>
                        <div class="clear"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include 'include/footer.php';
?>