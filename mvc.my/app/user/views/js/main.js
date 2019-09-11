

$(document).ready(function(){

    filter_data();

    function filter_data()
    {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var width = get_filter('width');
        var height = get_filter('height');
        var diameter = get_filter('diameter');
        var season = get_filter('season');
        var brands = get_filter('brands');
        $.ajax({
            url:"app/user/views/fetch_data.php",
            method:"POST",
            data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, width:width, height:height, diameter:diameter, season:season, brands:brands},
            success:function(data){
                $('.filter_data').html(data);
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });

    $('#price_range').slider({
        range:true,
        min:1000,
        max:65000,
        values:[1000, 65000],
        step:500,
        stop:function(event, ui)
        {
            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            filter_data();
        }
    });

});


jQuery(document).ready(function(){
  // This button will increment the value
  $('.qtyplus').click(function(e){
      // Stop acting like a button
      e.preventDefault();
      // Get the field name
      fieldName = $(this).attr('field');
      // Get its current value
      var currentVal = parseInt($('input[name='+fieldName+']').val());
      // If is not undefined
      if (!isNaN(currentVal)) {
          // Increment
          $('input[name='+fieldName+']').val(currentVal + 1);
      } else {
          // Otherwise put a 0 there
          $('input[name='+fieldName+']').val(0);
      }
  });
  // This button will decrement the value till 0
  $(".qtyminus").click(function(e) {
      // Stop acting like a button
      e.preventDefault();
      // Get the field name
      fieldName = $(this).attr('field');
      // Get its current value
      var currentVal = parseInt($('input[name='+fieldName+']').val());
      // If it isn't undefined or its greater than 0
      if (!isNaN(currentVal) && currentVal > 1) {
          // Decrement one
          $('input[name='+fieldName+']').val(currentVal - 1);
      } else {
          // Otherwise put a 0 there
          $('input[name='+fieldName+']').val(1);
      }
  });
});


	 $(document).ready(function(){
		$('#btn-send').click(function () {

				});
		});
		 $(document).ready(function(){
			$('#btn-send').click(function () {
				var email = $('#email').val();
				var text = $('#text').val();

			});
		});

 $(document).ready(function(){
    $('#btn-send_cart').click(function () {
        var email = $('#email').val();
        var text = $('#text').val();
        $.ajax({
            type: "POST", //метод передачи данных
            url: '/callback_cart_ajax.php', //обработчик php
            data: {email: email, text:text},//передаваемые данные
            success: function(data) { //получение результата
                var old = $('.modal-header').html();//получаем содежимое div
                $('.modal-header').html(old + data); //добавляем сообщение об отправке
                }
            });
    });
});







