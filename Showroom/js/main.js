$(document).ready(function(){
    $('.header_bottom_menu ul li a').hover(
        function(){ 
            $(this).find('.header_bottom_menu ul li a').toggleClass('drop_active');
        }
    );
});

$('.item_menu').mouseover(function(){
    $(this).addClass('drop_active');
    });
    $('.item_menu').mouseleave(function(){
    $(this).removeClass('drop_active');
    });
