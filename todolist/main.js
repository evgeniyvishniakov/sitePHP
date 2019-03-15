$('input:checkbox').click(function(){
    if ($(this).is(':checked')) {
        $(this).parent().addClass('active');
    } else {
        $(this).parent().removeClass('active');
    }
});