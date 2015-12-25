<?php


/**
 * Shipping Calculator
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.8
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

if ( get_option('woocommerce_enable_shipping_calc')=='no' || ! $woocommerce->cart->needs_shipping() )
	return;
?>

<?php // do_action( 'woocommerce_before_shipping_calculator' ); ?>



<?php if(isset ( $_REQUEST['calc_shipping'] )) {
	
	//print_r($_REQUEST);
	//new WC_Your_Shipping_Method();
	//WC_Your_Shipping_Method::$instance->calculate_shipping( '' );
}
?>

<link type="text/css" href="<?php  bloginfo('template_url'); ?>/calc_deliv_cdek_js/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
<script src="<?php  bloginfo('template_url'); ?>/calc_deliv_cdek_js/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="<?php  bloginfo('template_url'); ?>/calc_deliv_cdek_js/jquery-ui-1.8.21.custom.min.js" type="text/javascript"></script>
<script src="<?php  bloginfo('template_url'); ?>/calc_deliv_cdek_js/form2js.js" type="text/javascript"></script>
<script src="<?php  bloginfo('template_url'); ?>/calc_deliv_cdek_js/json2.js" type="text/javascript"></script>

<script type="text/javascript">

			/**
			 * автокомплит
			 * подтягиваем список городов ajax`ом, данные jsonp в зависмости от введённых символов
			 */
			$(function() {
			
				
				$("#city").autocomplete({
				source : function(request, response) {
					loadings = $("#cart-form .loading-layer");
				loadings.show();
						$.ajax({
							url : "http://api.cdek.ru/city/getListByTerm/jsonp.php?callback=?",
							dataType : "jsonp",
							data : {
								q : function() {
									return $("#city").val()
								},
								name_startsWith : function() {
									return $("#city").val()
								}
							},
							success : function(data) {
								data.geonames = data.geonames.splice(0, 4);
								response($.map(data.geonames, function(item) {
									return {
										 label : item.name,
										value : item.name,
									 	id : item.id
									}
								}));
							}
						});
					},
					minLength : 1,
					select : function(event, ui) {
						
						$('#receiverCityId').val(ui.item.id);
						
						
						$("#city").val( ui.item.value );
						
						
						if( Number( $("#receiverCityId").val() ) > 0 ) {
							$("#gotopay").removeAttr("disabled");
						}
						else
							$("#gotopay").attr("disabled", "disabled");
							
						
						
						ajaxUpdateShipping();
						
					}
				});
				
				
				
				
				
				/*$("input[name=update_cart], input.checkout-button").click(function (event) {
					
					var total_quantity = 0;
					$(".product-quantity .qty").each(function() {
						
						total_quantity += Number($(this).val());
					});
					
					$("#cdek input[name=total_items]").val( total_quantity );
					
					var form = $(this).parents("form");
					
					var target = $(this);
					
					$.ajax({type: "POST", data:  $("#cdek").serialize(), "success": function() {
					
					
						form.data("processed", true);
						target.click();
						//form.trigger("submit");
						
					}});
					
					console.log(form.data("processed"));
					
					
					if( !form.data('processed') )
						event.preventDefault();
										
				});*/

				
			});
</script>


		



<form id="cdek" class="shipping_calculator" action="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" method="post">

	
	
	<input type = 'hidden' value = '1' name =  'calc_shipping'/>
	
	

	<!--<section class="shipping-calculator-form">-->

	
	
		
	   <p class="form-row form-row-wide">
		
			
			<select class="wid200" id="city" name="country" onchange="ajaxUpdateShipping();">
					    <optgroup label="Города">
<option value="АБАКАН">АБАКАН</option>
<option value="АНАДЫРЬ">АНАДЫРЬ</option>
<option value="АНАПА">АНАПА</option>
<option value="АРХАНГЕЛЬСК">АРХАНГЕЛЬСК</option>
<option value="АСТРАХАНЬ">АСТРАХАНЬ</option>
<option value="БАЙКОНУР">БАЙКОНУР</option>
<option value="БАРНАУЛ">БАРНАУЛ</option>
<option value="БЕЛГОРОД">БЕЛГОРОД</option>
<option value="БИРОБИДЖАН">БИРОБИДЖАН</option>
<option value="БЛАГОВЕЩЕНСК">БЛАГОВЕЩЕНСК</option>
<option value="БРЯНСК">БРЯНСК</option>
<option value="ВЕЛИКИЙ НОВГОРОД">ВЕЛИКИЙ НОВГОРОД</option>
<option value="ВЛАДИВОСТОК">ВЛАДИВОСТОК</option>
<option value="ВЛАДИКАВКАЗ">ВЛАДИКАВКАЗ</option>
<option value="ВЛАДИМИР">ВЛАДИМИР</option>
<option value="ВОЛГОГРАД">ВОЛГОГРАД</option>
<option value="ВОЛОГДА">ВОЛОГДА</option>
<option value="ВОРКУТА">ВОРКУТА</option>
<option value="ВОРОНЕЖ">ВОРОНЕЖ</option>
<option value="ГОРНО-АЛТАЙСК">ГОРНО-АЛТАЙСК</option>
<option value="ГРОЗНЫЙ">ГРОЗНЫЙ</option>
<option value="ДУДИНКА">ДУДИНКА</option>
<option value="ЕКАТЕРИНБУРГ">ЕКАТЕРИНБУРГ</option>
<option value="ЕЛИЗОВО">ЕЛИЗОВО</option>
<option value="ИВАНОВО">ИВАНОВО</option>
<option value="ИЖЕВСК">ИЖЕВСК</option>
<option value="ИРКУТСК">ИРКУТСК</option>
<option value="ЙОШКАР-ОЛА">ЙОШКАР-ОЛА</option>
<option value="КАЗАНЬ">КАЗАНЬ</option>
<option value="КАЛИНИНГРАД">КАЛИНИНГРАД</option>
<option value="КАЛУГА">КАЛУГА</option>
<option value="КЕМЕРОВО">КЕМЕРОВО</option>
<option value="КИРОВ">КИРОВ</option>
<option value="КОСТОМУКША">КОСТОМУКША</option>
<option value="КОСТРОМА">КОСТРОМА</option>
<option value="КРАСНОДАР">КРАСНОДАР</option>
<option value="КРАСНОЯРСК">КРАСНОЯРСК</option>
<option value="КУРГАН">КУРГАН</option>
<option value="КУРСК">КУРСК</option>
<option value="КЫЗЫЛ">КЫЗЫЛ</option>
<option value="ЛИПЕЦК">ЛИПЕЦК</option>
<option value="МАГАДАН">МАГАДАН</option>
<option value="МАГНИТОГОРСК">МАГНИТОГОРСК</option>
<option value="МАЙКОП">МАЙКОП</option>
<option value="МАХАЧКАЛА">МАХАЧКАЛА</option>
<option value="МИНЕРАЛЬНЫЕ ВОДЫ">МИНЕРАЛЬНЫЕ ВОДЫ</option>
<option value="МИРНЫЙ">МИРНЫЙ</option>
<option value="МОСКВА" selected="selected">МОСКВА</option>
<option value="МУРМАНСК">МУРМАНСК</option>
<option value="МЫТИЩИ">МЫТИЩИ</option>
<option value="НАБЕРЕЖНЫЕ ЧЕЛНЫ">НАБЕРЕЖНЫЕ ЧЕЛНЫ</option>
<option value="НАДЫМ">НАДЫМ</option>
<option value="НАЗРАНЬ">НАЗРАНЬ</option>
<option value="НАЛЬЧИК">НАЛЬЧИК</option>
<option value="НАРЬЯН-МАР">НАРЬЯН-МАР</option>
<option value="НЕРЮНГРИ">НЕРЮНГРИ</option>
<option value="НЕФТЕЮГАНСК">НЕФТЕЮГАНСК</option>
<option value="НИЖНЕВАРТОВСК">НИЖНЕВАРТОВСК</option>
<option value="НИЖНИЙ НОВГОРОД">НИЖНИЙ НОВГОРОД</option>
<option value="НОВОКУЗНЕЦК">НОВОКУЗНЕЦК</option>
<option value="НОВОРОССИЙСК">НОВОРОССИЙСК</option>
<option value="НОВОСИБИРСК">НОВОСИБИРСК</option>
<option value="НОВЫЙ УРЕНГОЙ">НОВЫЙ УРЕНГОЙ</option>
<option value="НОРИЛЬСК">НОРИЛЬСК</option>
<option value="НОЯБРЬСК">НОЯБРЬСК</option>
<option value="ОМСК">ОМСК</option>
<option value="ОРЁЛ">ОРЁЛ</option>
<option value="ОРЕНБУРГ">ОРЕНБУРГ</option>
<option value="ПЕНЗА">ПЕНЗА</option>
<option value="ПЕРМЬ">ПЕРМЬ</option>
<option value="ПЕТРОЗАВОДСК">ПЕТРОЗАВОДСК</option>
<option value="ПЕТРОПАВЛОВСК-КАМЧАТСКИЙ">ПЕТРОПАВЛОВСК-КАМЧАТСКИЙ</option>
<option value="ПСКОВ">ПСКОВ</option>
<option value="РОСТОВ-НА-ДОНУ">РОСТОВ-НА-ДОНУ</option>
<option value="РЯЗАНЬ">РЯЗАНЬ</option>
<option value="САЛЕХАРД">САЛЕХАРД</option>
<option value="САМАРА">САМАРА</option>
<option value="САНКТ-ПЕТЕРБУРГ">САНКТ-ПЕТЕРБУРГ</option>
<option value="САРАНСК">САРАНСК</option>
<option value="САРАТОВ">САРАТОВ</option>
<option value="СМОЛЕНСК">СМОЛЕНСК</option>
<option value="СОЧИ">СОЧИ</option>
<option value="СТАВРОПОЛЬ">СТАВРОПОЛЬ</option>
<option value="СТРЕЖЕВОЙ">СТРЕЖЕВОЙ</option>
<option value="СУРГУТ">СУРГУТ</option>
<option value="СЫКТЫВКАР">СЫКТЫВКАР</option>
<option value="ТАМБОВ">ТАМБОВ</option>
<option value="ТВЕРЬ">ТВЕРЬ</option>
<option value="ТОЛЬЯТТИ">ТОЛЬЯТТИ</option>
<option value="ТОМСК">ТОМСК</option>
<option value="ТУЛА">ТУЛА</option>
<option value="ТЫНДА">ТЫНДА</option>
<option value="ТЮМЕНЬ">ТЮМЕНЬ</option>
<option value="УЛАН-УДЭ<">УЛАН-УДЭ</option>
<option value="УЛЬЯНОВСК">УЛЬЯНОВСК</option>
<option value="УСИНСК">УСИНСК</option>
<option value="УФА">УФА</option>
<option value="УХТА">УХТА</option>
<option value="ХАБАРОВСК">ХАБАРОВСК</option>
<option value="ХАНТЫ-МАНСИЙСК">ХАНТЫ-МАНСИЙСК</option>
<option value="ХОЛМСК">ХОЛМСК</option>
<option value="ЧЕБОКСАРЫ">ЧЕБОКСАРЫ</option>
<option value="ЧЕЛЯБИНСК">ЧЕЛЯБИНСК</option>
<option value="ЧЕРЕПОВЕЦ">ЧЕРЕПОВЕЦ</option>
<option value="ЧЕРКЕССК">ЧЕРКЕССК</option>
<option value="ЧИТА">ЧИТА</option>
<option value="ЭЛИСТА">ЭЛИСТА</option>
<option value="ЮЖНО-САХАЛИНСК">ЮЖНО-САХАЛИНСК</option>
<option value="ЯКУТСК">ЯКУТСК</option>
<option value="ЯРОСЛАВЛЬ">ЯРОСЛАВЛЬ</option>
					    </optgroup>
					  
					</select>
					<script>
					$("#city [value='<?php print @$_SESSION['country']; ?>']").attr("selected", "selected");

					</script>
		</p>
			
		<?php global $total_items; ?>
		
			<input type="hidden" name="cart_total" value="<?php print $woocommerce->cart->cart_contents_total; ?>" />
			<input type = 'hidden' name = 'calc_tip' value = '<? echo ($_SESSION['calc_tip']);?>'/>
			
			<input type = 'hidden' name = 'calc_shipping_country' value = 'RU' />
			<input name="senderCityId" value="152" type = 'hidden' /> <!-- Город-отправитель, Новосибирск -->
			<input name="receiverCityId" id="receiverCityId" value="<?php print @$_SESSION['receiverCityId']; ?>" type = 'hidden' /> <!-- Город-получатель -->
			
			<!-- <input name="tariffId" value="137" hidden /> --> <!-- id тарифа, Посылка склад-дверь -->
			<input name="tariffList1" value="10" type = 'hidden' />
			<input name="tariffList2" value="137" type = 'hidden' />
			
			<input name="modeId" value="2" type = 'hidden' /> <!-- режим доставки, склад-дверь -->
			<input name="dateExecute" value="2013-10-20" type = 'hidden' /> <!-- Дата доставки -->
			
			<input name="weight1" value="0.020" type = 'hidden' /> <!-- Вес места, кг.  -->
			<input name="length1" value="20" type = 'hidden' /> <!-- Длина места, см. -->
			<input name="width1" value="20" type = 'hidden' /> <!-- Ширина места, см. -->
			<input name="height1" value="20" type = 'hidden' /> <!-- Высота места, см. -->			
			
			
			<input name = 'total_items' value = '<?php print $total_items; ?>' type = 'hidden' />
			
	
	
	
		<!--<p class="form-row form-row-wide">
			<select name="calc_shipping_country" id="calc_shipping_country" class="country_to_state" rel="calc_shipping_state">
				<option value=""><?php _e( 'Select a country&hellip;', 'woocommerce' ); ?></option>
				<?php
					foreach( $woocommerce->countries->get_allowed_countries() as $key => $value )
						echo '<option value="' . esc_attr( $key ) . '"' . selected( $woocommerce->customer->get_shipping_country(), esc_attr( $key ), false ) . '>' . esc_html( $value ) . '</option>';
				?>
			</select>
		</p>-->

		<p class="form-row form-row-wide">
			<?php
				$current_cc = $woocommerce->customer->get_shipping_country();
				$current_r  = $woocommerce->customer->get_shipping_state();
				$states     = $woocommerce->countries->get_states( $current_cc );

				// Hidden Input
				if ( is_array( $states ) && empty( $states ) ) {

					?><input type="hidden" name="calc_shipping_state" id="calc_shipping_state" placeholder="<?php _e( 'State / county', 'woocommerce' ); ?>" /><?php

				// Dropdown Input
				} elseif ( is_array( $states ) ) {

					?><span>
						<select name="calc_shipping_state" id="calc_shipping_state" placeholder="<?php _e( 'State / county', 'woocommerce' ); ?>">
							<option value=""><?php _e( 'Select a state&hellip;', 'woocommerce' ); ?></option>
							<?php
								foreach ( $states as $ckey => $cvalue )
									echo '<option value="' . esc_attr( $ckey ) . '" ' . selected( $current_r, $ckey, false ) . '>' . __( esc_html( $cvalue ), 'woocommerce' ) .'</option>';
							?>
						</select>
					</span><?php

				// Standard Input
				} else {

					?><input type="hidden" class="input-text" value="<?php print uniqid (); //echo esc_attr( $current_r ); ?>" placeholder="<?php _e( 'State / county', 'woocommerce' ); ?>" name="calc_shipping_state" id="calc_shipping_state" />
<?php

				}
			?>
		</p>

		<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_city', false ) ) : ?>

			<p class="form-row form-row-wide">
				<input type="hidden" class="input-text" value="<?php print uniqid (); //echo esc_attr( $woocommerce->customer->get_shipping_city() ); ?>" placeholder="<?php _e( 'City', 'woocommerce' ); ?>" name="calc_shipping_city" id="calc_shipping_city" />
			</p>

		<?php endif; ?>

		<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_postcode', true ) ) : ?>

			<p class="form-row form-row-wide">
				<input type="hidden" class="input-text" value="<?php print uniqid();//echo esc_attr( $woocommerce->customer->get_shipping_postcode() ); ?>" placeholder="<?php _e( 'Postcode / Zip', 'woocommerce' ); ?>" name="calc_shipping_postcode" id="calc_shipping_postcode" />
			</p>

		<?php endif; ?>
		
		
		<p><button style = 'width: 0; height: 0; border: none; font-size: 0; padding: 0; margin: 0;' type="submit" name="calc_shipping" value="1" class="button"><?php _e( 'Расчитать доставку', 'woocommerce' ); ?></button></p>

		<?php $woocommerce->nonce_field('cart') ?>
	<!--</section>-->
</form>

<?php do_action( 'woocommerce_after_shipping_calculator' ); ?>