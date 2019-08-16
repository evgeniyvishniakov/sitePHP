
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

// $(document).ready(function() {
//     $('#form_reg').submit(function(e) {
//         var login = $('#login').val();
//         var email = $('#email').val();
//         var pass = $('#password').val();
//         var alarm = false;
//
//         $(".error").remove();
//
//         if (login.length< 3) {
//             $('#login').after('<span class="error">Это поле нужно заполнить</span>');
//             alarm = true;
//         }
//         if (email.length< 1) {
//             $('#email').after('<span class="error">Это поле нужно заполнить</span>');
//             alarm = true;
//         } else {
//             var regEx = /^\w+([\.-]?\w+)*@(((([a-z0-9]{2,})|([a-z0-9][-][a-z0-9]+))[\.][a-z0-9])|([a-z0-9]+[-]?))+[a-z0-9]+\.([a-z]{2}|(com|net|org|edu|int|mil|gov|arpa|biz|aero|name|coop|info|pro|museum))$/i;
//             var validEmail = regEx.test(email);
//             if (!validEmail) {
//                 $('#email').after('<span class="error">Не правильно!!</span>');
//                 alarm = true;
//             }
//         }
//         if(region == 0){
//             $('#region').after('<span class="error">Нужно выбрать область</span>');
//             alarm = true;
//         }
//         if(city == 0){
//             $('#city').after('<span class="error">Нужно выбрать город</span>');
//             alarm = true;
//         }
//         if(area == 0){
//             $('#area').after('<span class="error">Нужно выбрать район</span>');
//             alarm = true;
//         }
//
//         if(alarm === true){
//             e.preventDefault();
//         }
//
//     });
// });
