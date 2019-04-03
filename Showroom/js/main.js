$('.link').hover(function() {
    $(this).next().show(); // получаем следующий за данным .link элемент (т.е. span)
}, 
function() {
    $(this).next().hide();
});

