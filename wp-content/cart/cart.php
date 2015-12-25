<?php

$order_limit = 3000.00;

/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

$woocommerce->show_messages();
?>

<?php do_action( 'woocommerce_before_cart' ); ?>

<style>
</style>
<script>

(function($) {

	$(function() {
	
		// Update both total cart and shipping
		ajaxUpdate = function (event) {
				 var rarr=document.getElementsByName("group1");
			var form = $("#cart-form"),
				
				loadings = $("#cart-form .loading-layer");
				loadings.show();
			
					$.ajax({type: "POST", data:  form.serialize(), "success": function( responce ) {
					
						var $html = $( responce );
							
						$(".cart-collaterals").html( $html.find(".cart-collaterals").html() );
						
						$(".cart_table_item").each(function(index) {
						
							$(this).find(".product-subtotal .amount").text(
								$html.find(".cart_table_item:nth-child(" + (index + 1) + ") .product-subtotal .amount").text()
							)
						});
						
						$("#cart-form tbody tr:last-child").html( $html.find("#cart-form tbody tr:last-child").html() );
						
							 if (rarr[0].checked) {document.getElementsByName("calc_tip")[0].setAttribute("value","1");console.log('vibor 1');}
				 	 if (rarr[1].checked) {document.getElementsByName("calc_tip")[0].setAttribute("value","2");console.log('vibor 2');}
						$.ajax({type: "POST", data:  $("#cdek").serialize(), "success": function( responce ) {
						
							var $html = $( responce ).find(".cart-collaterals");
							
						$(".cart-collaterals").html( $html.html().replace("(Бесплатно!)", "") );
							
							$("#gotopay").removeAttr("disabled");
						
							loadings.hide();
							b = $('.product-subtotal .amount').text();
		b=b.replace("руб.","");
					bb = $('.cart-subtotal').text();
		bb=bb.replace("руб.","");bb=bb.replace("Подитог корзины","");console.log(bb); if (bb>10000) console.log("bolshe");
		if (bb<3000) {$('.ck2').css('display','none');$('.sorry').css('display','block');}
		else{
		$('.ck2').css('display','block');$('.sorry').css('display','none');
		}
			b = $('.total .amount').text();
		b=b.replace("руб.","");console.log(b);
		if (bb>10000) {
		$('.gr2').css('opacity', '0.1');$('.ggr ').attr('disabled',true);
	 if ($('.ggr').ckecked=true) {
	
	 document.getElementsByName("calc_tip")[0].setAttribute("value","1");$('.ggr2').attr("checked", true);
;} ajaxUpdateShipping ();}else
	
	{$('.gr2').css('opacity', '1');$('.ggr ').attr('disabled',false)}
	;
	
						}});
						
						
					}});
					if(event.keyCode==13){return false;}
	
		}
		// Update Only shipping
		checkc = function ( event ) {
		 var rarr=document.getElementsByName("group1"); if (rarr[0].checked) {document.getElementsByName("calc_tip")[0].setAttribute("value","1");console.log('vibor 1');}
				 	 if (rarr[1].checked) {document.getElementsByName("calc_tip")[0].setAttribute("value","2");console.log('vibor 2');}
		}
		ajaxUpdateShipping = function ( event ) {
				
	
			var form = $("#cart-form"),
				
				loadings = $("#cart-form .loading-layer");
				loadings.show();
			
			$.ajax({type: "POST", data:  $("#cdek").serialize(), "success": function( responce ) {
						
				
				var $html = $( responce ).find(".cart-collaterals");

				
     			$(".cart-collaterals").html( $html.html().replace("(Бесплатно!)", "") );
							
						
				if( $("#receiverCityId").val() )
					$("#gotopay").removeAttr("disabled");
						b = $('.cart-subtotal').text();
		b=b.replace("руб.","");b=b.replace("Подитог корзины","");	

		if (b>10000) {
		$('.gr2').css('opacity', '0.1');$('.ggr ').attr('disabled',true)
	}else
	
	{$('.gr2').css('opacity:', '1');$('.ggr ').attr('disabled',false)}		
				loadings.hide();
			}});
		};

		ajaxUpdateShipping( null );
	
		$("#cart-form .product-quantity .qty").change(ajaxUpdate);
		
		
		$(document).on( 'click', '#cart-form .plus, #cart-form .minus', function(Event) { b = $('.product-subtotal .amount').text();
		b = $('.cart-subtotal').text();
		b=b.replace("руб.","");b=b.replace("Подитог корзины","");	
window.setTimeout(ajaxUpdate, 100); });
		$(document).ready(function(){ 		b = $('.total .amount').text();
		b=b.replace("руб.","");		console.log('111');
		if (b>10000) {console.log('1113');
		$('.gr2').css('opacity', '0.1');$('.ggr ').attr('disabled',true)
	}else
	
	{$('.gr2').css('opacity:', '1');$('.ggr ').attr('disabled',false)} })
		
	});

})(jQuery);

</script>

<div id="ccc">

<form action="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" method="post" id = 'cart-form'>

<?php do_action( 'woocommerce_before_cart_table' ); ?>
<input type="hidden"  name="update_cart" value="<?php _e( 'Update Cart', 'woocommerce' ); ?>" /> 




<?php  

	//var_dump ( $_REQUEST );
	
	//var_dump ($woocommerce->session->chosen_shipping_method);
	//print "dsdsdsdsds";
	//$m = new WC_Your_Shipping_Method();
	//add_action( 'woocommerce_shipping_init', 'your_shipping_method_init' );
	//$m->calculate_shipping( '' );
 
?>





<table class="shop_table cart" cellspacing="0">
	<thead>
		<tr>
			<th class="product-remove">&nbsp;</th>
			<!--<th class="product-thumbnail">&nbsp;</th>-->
			<!---<th class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>-->
			
			<th class="product-name"><?php _e( 'Код' ); ?></th>
			<th class="product-name"><?php _e( 'Размер' ); ?></th>
			<th class="product-name"><?php _e( 'Тип' ); ?></th>
			<th class="product-name"><?php _e( 'Наличие' ); ?></th>
			
			<th class="product-price"><?php _e( 'Цена 1шт.' ); ?></th>
			<th class="product-quantity"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
			<th class="product-subtotal"><?php _e( 'Сумма' ); ?></th>
		</tr>
	</thead>
	<tbody>
	
	
		<?php do_action( 'woocommerce_before_cart_contents' ); ?>

		<?php
		
		$o_count = 0; $o_total = 0.00; $has_o = false;
		
		global $total_items;
		
		$total_items = 0;
		
		
		if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) {
			foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values ) {
			
			
				$total_items += (int)$values['quantity'];
			
				
					
				$has_o = true;
				
				$o_count += $values['quantity'];
				$o_total += (float)$values['line_total'];
				
			
				$_product = $values['data'];
				
				
				
				
				if ( $_product->exists() && $values['quantity'] > 0 ) {
					?>
					<tr class = "<?php echo esc_attr( apply_filters('woocommerce_cart_table_item_class', 'cart_table_item', $values, $cart_item_key ) ); ?>">
						<!-- Remove from cart link -->
						<td class="product-remove">
							<?php
								echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'woocommerce' ) ), $cart_item_key );
							?>
						</td>

						<!-- The thumbnail -->
					<!--	<td class="product-thumbnail">
							<?php
								$thumbnail = apply_filters( 'woocommerce_in_cart_product_thumbnail', $_product->get_image(), $values, $cart_item_key );

								if ( ! $_product->is_visible() || ( ! empty( $_product->variation_id ) && ! $_product->parent_is_visible() ) )
									echo $thumbnail;
								else
									printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), $thumbnail );
							?>
						</td>-->

						<!-- Product Name -->
						<!--<td class="product-name">
							<?php
								if ( ! $_product->is_visible() || ( ! empty( $_product->variation_id ) && ! $_product->parent_is_visible() ) )
									echo apply_filters( 'woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key );
								else
									printf('<span>%s</span>',  apply_filters('woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key ) );

								// Meta data
								echo $woocommerce->cart->get_item_data( $values );

                   				// Backorder notification
                   				if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $values['quantity'] ) )
                   					echo '<p class="backorder_notification">' . __( 'Available on backorder', 'woocommerce' ) . '</p>';
							?>
						</td>-->
						
						
						
						<!-- Product code -->
						
						<td class="product-name">
							<?php print $_product->post->post_title;   ?>
						</td>
						
						
						<!-- Product code -->
						
						<td class="product-name">
							<?php print $_product->get_attribute('size'); ?>
						</td>
						
						<td class="product-name">
							<?php print $_product->get_attribute('type'); ?>
						</td>
						
						
						<td class="product-name">
							<?php print $_product->get_stock_quantity(); ?>
						</td>

						<!-- Product price -->
						<td class="product-price">
							<?php
								$product_price = get_option('woocommerce_tax_display_cart') == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();

								echo apply_filters('woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $values, $cart_item_key );
							?>
						</td>

						<!-- Quantity inputs -->
						<td class="product-quantity">
							<div class = 'p-wr'>
							<div class = 'loading-layer'></div>
							<?php
								if ( $_product->is_sold_individually() ) {
									$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
								} else {

									$step	= apply_filters( 'woocommerce_quantity_input_step', '1', $_product );
									$min 	= apply_filters( 'woocommerce_quantity_input_min', '', $_product );
									$max 	= apply_filters( 'woocommerce_quantity_input_max', $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(), $_product );

									$product_quantity = sprintf( '<div class="quantity"><input type="number" onkeydown="if(event.keyCode==13){return false;}"  name="cart[%s][qty]" step="%s" min="%s" max="%s" value="%s" size="4" title="' . _x( 'Qty', 'Product quantity input tooltip', 'woocommerce' ) . '" class="input-text qty text" maxlength="12" /></div>', $cart_item_key, $step, $min, $max, esc_attr( $values['quantity'] ) );
								}

								echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
							?>
							</div>
						</td>

						<!-- Product subtotal -->
						<td class="product-subtotal">
							<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', $woocommerce->cart->get_product_subtotal( $_product, $values['quantity'] ), $values, $cart_item_key );
							?>
						</td>
					</tr>
					<?php
				}
			}
		}

		do_action( 'woocommerce_cart_contents' );
		?>	
		<tr>
			<td colspan="9" class="actions">

				<?php if ( $woocommerce->cart->coupons_enabled() ) { ?>
					<div class="coupon">

						<label for="coupon_code"><?php _e( 'Coupon', 'woocommerce' ); ?>:</label> <input name="coupon_code" class="input-text" id="coupon_code" value="" /> <input type="submit" class="button" name="apply_coupon" value="<?php _e( 'Apply Coupon', 'woocommerce' ); ?>" />

						<?php do_action('woocommerce_cart_coupon'); ?>

					</div>
				<?php } ?>

				
				
				<input type="button" onclick = 'window.location = "/katalog/?cat_page=1&order_by=size&order=asc"' class="checkout-button button alt" style = 'float: left'  value="&larr; Назад в каталог" />
				<p class="sorry" style="display: none;"><strong> Извините, сумма оптового заказа должна быть не менее 3000 руб. </strong></p>
				
				<?php if( $o_total < $order_limit): ?>
				
					<p class = 'sorry'><strong> Извините, сумма оптового заказа должна быть не менее <?php print $order_limit; ?> руб. </strong></p>
				<?php else: ?>
				<div class="loading-layer" style="display: block;"></div>
				<input id = 'gotopay' type="submit" disabled class="checkout-button button alt ck2" name="proceed" value="<?php _e( 'Proceed to Checkout &rarr;', 'woocommerce' ); ?>" />
				
					
				<?php endif; ?>
				
			
				

				<?php do_action('woocommerce_proceed_to_checkout'); ?>

				<?php $woocommerce->nonce_field('cart') ?>
			</td>
		</tr>
		<tr>
		<td colspan="9" height="40"><span style="margin-left:40px;">Доставка:</span> </td></tr>
		<tr height="230">
		<td colspan="9" height="230">
<input type="radio" name="group1" value="Butter" <? if (($_SESSION['calc_tip']==1)OR(!isset($_SESSION['caly_tip']))) echo " checked";?> onclick="checkc();ajaxUpdateShipping();" class="ggr2"> <span class="hrb">Доставка курьерской службой(Экспресс-доставка).</span><br/><div class="opisr">Сроки доставки рассчитываются индивидуально.<br>Доставка производится курьером лично в руки на указанный клиентом адрес<br/> Для отслеживания передвижения посылки высылается трекинг-номер.</div><? $a=$values['line_subtotal'];;if($a<15000000){ ?><div class="gr2"><input type="radio" name="group1" <? if(($_SESSION['caly_tip']==2)) echo " checked";?> value="Milk" onclick="checkc();ajaxUpdateShipping();" class="ggr"> <span class="hrb">Доставка 1 классом почты России(Авиа).</span><br/><div class="opisr">Сроки доставки 7-12 дней.<br>Способ доставки для заказов до 10000 рублей!<br>Клиент получает заказ самостоятельно в своем почтовом отделении.<br/> Для отслеживания передвижения посылки высылается трекинг-номер.</div></div><? }?>
</td> 

		</tr>
<tr><td></td></tr>		
		
		

		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	</tbody>
</table>



<?php do_action( 'woocommerce_after_cart_table' ); ?>

</form>




<div class="cart-collaterals">


<?php do_action('woocommerce_cart_collaterals'); ?>

<?php woocommerce_cart_totals(); ?>

<?php woocommerce_shipping_calculator(); ?>

	

	

	

</div>
</div>
<?php do_action( 'woocommerce_after_cart' ); ?>