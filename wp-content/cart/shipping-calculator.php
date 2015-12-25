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
			<input id="city" name = 'country' onkeydown="if(event.keyCode==13){return false;}" value = '<?php print @$_SESSION['country']; ?>' class = 'input-text' type = 'text' placeholder = 'Введите город' />
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