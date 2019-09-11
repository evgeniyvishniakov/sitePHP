<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta type="keywords" content="...">
    <meta type="description" content="...">
    <title>Document</title>
    <link rel="stylesheet" href="../app/admin/views/css/main.css">
    <link rel="stylesheet" type="text/css" href="../app/admin/views/fonts/font-awesome-4.7.0/css/font-awesome.min.css">

</head>
<body>
<div class="vg-carcass vg-hide">
    <div class="vg-main">
        <div class="vg-one-of-twenty vg-firm-background-color2  vg-center">
            <a href="/" target="_blank">
                <div class="vg-element vg-full">
                    <span class="vg-text2 vg-firm-color1">Site</span>
                </div>
            </a>
        </div>
        <div class="vg-element vg-ninteen-of-twenty vg-firm-background-color4 vg-space-between  vg-box-shadow vg-head_line">
            <div class="vg-element vg-third">
                <div class="vg-element vg-fifth vg-center" id="hideButton">
                    <div>
                        <img src="../app/admin/views/img/menu-button.png" alt="">
                    </div>
                </div>
                <div class="vg-element vg-wrap-size vg-left vg-search  vg-relative" id="searchButton">
                    <div>
                        <img src="../app/admin/views/img/search.png" alt="">
                    </div>
                    <form method="post" action="/search" autocomplete="off">
                        <input type="text" name="search" class="vg-input vg-text">
                        <div class="vg-element vg-firm-background-color4 vg-box-shadow search_links search_res"></div>
                    </form>
                </div>
            </div>
            <!--кнопка-->
            <a href="/createsitemap" class="vg-element vg-box-shadow sitemap-button">
                            <span class="vg-text vg-firm-color1">
                                Create sitemap
                            </span>
            </a>
            <!--/кнопка-->
            <div class="vg-element vg-fifth">
                <div class="vg-element vg-half vg-right">
                    <div class="vg-element vg-text vg-center">
                        <span class="vg-firm-color5">admin</span>
                    </div>
                </div>
                <a href="/logout" class="vg-element vg-half vg-center">
                    <div>
                        <img src="../app/admin/views/img/out.png" alt="">
                    </div>
                </a>
            </div>
        </div>
    </div>
