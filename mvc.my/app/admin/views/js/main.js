
$(document).ready(function() {
  //прикрепляем клик по заголовкам acc-head
	$('.accordeon .acc-head').on('click', f_acc);
});
 
function f_acc(){
//скрываем все кроме того, что должны открыть

  $('.accordeon .acc-body').not($(this).next()).slideUp(500);
// открываем или скрываем блок под заголовком, по которому кликнули
 $(this).next().slideToggle(500);
}	


