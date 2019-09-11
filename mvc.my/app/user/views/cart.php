<?php
include 'include/head.php';
include 'include/header.php';
?>
<div class="cart">
	<div class="container">
		<div class="row">
			<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
				<div class="order-form onetovat_tabs">
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation">
							<a href="#new-user" aria-controls="new-user" role="tab" data-toggle="tab">Новый покупатель</a>
						</li>
						<li role="presentation">
							<a href="#i-have-profile" aria-controls="i-have-profile" role="tab" data-toggle="tab">Войти</a>
						</li>
					</ul>
					<div class="tab-content ul-inside">
						<div role="tabpanel" class="tab-pane active" id="new-user">
							<div class="order-form__form-container">
								<form role="form" id="order-form-1-storage" action="#order-form-1-storage" class="form-horizontal cookieForm" data-toggle="validator" method="POST" novalidate="true">
									<div class>
										<div class="form-group clearfix">
											<div class="col-sm-12">
												<input type="text" name="fname" value="" placeholder="Фамилия*" required="required" class="form-control">
											</div>
										</div>
										<div class="form-group clearfix">
											<div class="col-sm-12">
												<input type="text" name="uname" value="" placeholder="Имя*" required="required" class="form-control">
											</div>
										</div>
										<div class="form-group clearfix">
											<div class="col-sm-12">
												<div class="relative">
													<input type="text" name="phone" id="order-phones" value="" placeholder="Телефон*" required="required" class="form-control" autocomplete="off">
													<div class="autocomplete" style="position: absolute; display: none; max-height: 300px; z-index: 9999;"></div></div>
											</div>
											<script>
												var OrderPhones = [
												];</script>
										</div>
										<div class="form-group clearfix">
											<div class="col-sm-12">
												<input type="email" name="email" value="" placeholder="E-mail" class="form-control">
											</div>
										</div>
									</div>
									<div class="form-group clearfix has-error">
										<div class="col-sm-12">
											<div class="cms-select">
												<select name="delivery" id="order-delivery" required="" default="">
													<option value="">
														Способ доставки*
													</option><option price="0" city="" value="25819" adres="Адрес" is_adres="0" adres_price="70" is_dt="0" is_shops="0" is_np="1" data-has-text="1">
														Новая Почта
													</option><option price="0" city="" value="57857" adres="Адрес" is_adres="0" adres_price="70" is_dt="0" is_shops="0" is_np="1" data-has-text="1">
														Интайм
													</option></select>
											</div>
										</div>
									</div>
									<div class="form-group clearfix">
										<div class="col-sm-12">
											<textarea name="comment" class="form-control" placeholder="Комментарий"></textarea>
										</div>
									</div>
									<div class="form-group clearfix">
										<div class="col-sm-12 text-right">
											<a onclick="$(this).closest('form').submit();" class="btn btn-default invert">
												ОФОРМИТЬ ЗАКАЗ
											</a>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
				<form method="post" role="form" class="form-horizontal">
					<input type="hidden" name="action" value="recalc">
					<input type="hidden" name="delT" id="delT" value="">

					<div class="order-cart">
						<div class="order-cart__h1">
							ВАШ ЗАКАЗ
						</div>
						<div class="ajax-cart">
							<div class="ajax-cart__table">
								<div class="ajax-cart__table__tr">
									<div class="ajax-cart__table__tr__image">
										<a href="https://alfashina.ua/shiny/215-60-r16-premiorri-viamaggiore-95t/">
											<img src="https://alfashina.ua/data_resized/2/8/c/8/0/28c805cdf3f9ab97d989fafbe957b863756c878c.jpeg" class="ajax-cart__table__tr__image__img">
										</a>
									</div>
									<div class="ajax-cart__table__tr__name">
										<a href="https://alfashina.ua/shiny/215-60-r16-premiorri-viamaggiore-95t/">
											Premiorri ViaMaggiore 215/60 R16 95T
										</a>
										<div class="onetovar__id">
											Код товара:
											<b>78969</b>
											|
											<span class="onetovar__nal">
												<span class="oneTovarPlitka__nal-box__nal" style="color:#00b300;" data-naltext-id="57909">в наличии</span>
											</span>
											<div class="oneTovarPlitka__storage" data-storage="1" style="color:#ff8021;">
												На складе в Киеве
											</div>
										</div>
										<div>
											<span class="onetovar__cena"><span>1006</span> грн</span>
										</div>
										<div class="ajax-cart__table__cnt">
										</span>
											<span class="cart_cnt_767ba422527b545edd9487f8eff4ec07 ajax-cart__table__cnt__count">4</span> шт
											<span onclick="Cart.AddToCart(78969, 1 );" class="ajax-cart__table__cnt__plus">
											<i class="fa fa-plus" aria-hidden="true"></i>
											<i class="fa fa-minus" aria-hidden="true"></i>
										</span>
										</div>
									</div>
									<div class="ajax-cart__table__tr__price">
										<div class="tovars-top__price tovars-top__price__ajax-cart">
											<span class="onetovar__cena__old" data-default="0"><span></span></span>
											<span class="onetovar__cena" data-default="1006"><span>4024</span> грн</span>
										</div>
									</div>
									<div class="ajax-cart__table__tr__favorit">
										<a onclick="Favorit.toFavorit(78969);" class="favorit-id-78969 " data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Добавить в мои желания">
											<i class="fa fa-heart-o" aria-hidden="true">Like</i>
										</a>
									</div>
									<div class="ajax-cart__table__tr__delete">
										<a onclick="Cart.deleteItem( 78969, $(this) );" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Удалить из корзины">
											<span class="lnr lnr-cross">Х</span>
										</a>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-7 col-md-6 col-sm-4 col-xs-12">
							</div>
							<div class="col-lg-5 col-md-6 col-sm-8 col-xs-12">
								<div class="ajax-cart__footer" data-cart-footer-storage="">
									<div class="ajax-cart__itogo clearfix">
										<div class="ajax-cart__itogo__text">Сумма:</div>
										<div class="ajax-cart__itogo__value">4024 грн</div>
									</div>
									<div class="ajax-cart__itogo ajax-cart__itogo__summ clearfix">
										<div class="ajax-cart__itogo__text">Итого:</div>
										<div class="ajax-cart__itogo__value">4024грн</div>
									</div>
									<script>
									</script>
								</div>

							</div>
						</div>
						<a href="" class="btn btn-default order-cart__button-catalog">
							<i class="fa fa-angle-left" aria-hidden="true"></i>
							&nbsp;
							ПРОДОЛЖИТЬ ПОКУПКИ
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
include 'include/footer.php';
?>
