<?php

$order_limit = 1.00;

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

			<script type="text/javascript">
			

			function getList(type, obj) {
				console.log($("#country").val());
			if (($("#country").val()==245) || ($("#country").val()==248) || ($("#country").val()==1894) ) 
					
					{		$('.gr2').css('opacity', '0.1');$('.ggr ').attr('disabled',true);	 document.getElementsByName("calc_tip")[0].setAttribute("value","1");$('.ggr2').attr("checked", true);ajaxUpdateShipping ()

}
else {
	bb = $('.cart-subtotal').text();bb=bb.replace("руб.","");bb=bb.replace("Подитог корзины","");
if (bb<20000){$('.gr2').css('opacity', '1');$('.ggr ').attr('disabled',false);console.log('Russsssssssia');}}
				$('#loading_' + type).show();
				$.post('/ajax/city.php', {type: type, id: $('#'+obj).val()}, onAjaxSuccess);
				function onAjaxSuccess(data) {
			        	out = document.getElementById(type);
			 			for (var i = out.length - 1; i >= 0; i--) {
			      			out.options[i] = null;
			 			}
			        	eval(data);
			        	$('#loading_' + type).hide();
						

				}	


				
				


			}
			</script>
			
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
		bb=bb.replace("руб.","");bb=bb.replace("Подитог корзины","");console.log(bb); if (bb>20000) console.log("bolshe");
		if (bb<1) {$('.sorry').css('display','block');}
		else{
		$('.ck2').css('display','block');$('.sorry').css('display','none');
		}
			b = $('.total .amount').text();
		b=b.replace("руб.","");console.log(b);
		
		if (bb>20000) {
		$('.gr2').css('opacity', '0.1');$('.ggr ').attr('disabled',true);
	 if ($('.ggr').ckecked=true) {
	
	 document.getElementsByName("calc_tip")[0].setAttribute("value","1");$('.ggr2').attr("checked", true);
;} ajaxUpdateShipping ();}else
	
	{
		if (($("#country").val()==3159) ){
						
$('.gr2').css('opacity', '1');$('.ggr ').attr('disabled',false);}
}
	
	
						}});
						
						
					}});
					if(event.keyCode==13){return false;}
	
		}
		// Update Only shipping
		checkc = function ( event ) {
			document.getElementById('gotopay').style.display='block';
		 var rarr=document.getElementsByName("group1"); if (rarr[0].checked) {document.getElementsByName("calc_tip")[0].setAttribute("value","1");console.log('vibor 1');}
				 	 if (rarr[1].checked) {document.getElementsByName("calc_tip")[0].setAttribute("value","2");console.log('vibor 2');}
		}
		ajaxUpdateShipping = function ( event ) {
		//$('#city2').val($("#city").val());
	
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

		if (b>20000) {
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
window.setTimeout(ajaxUpdate,1); });
		$(document).ready(function(){ 		b = $('.total .amount').text();
		b=b.replace("руб.","");		console.log('111');
		if (b>20000) {console.log('1113');
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
				<p class="sorry" style="display: none;"><strong> Извините, сумма оптового заказа должна быть не менее 5000 руб. </strong></p>
				
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
		<td colspan="9" height="40"><span style="margin-left:40px;">Доставка в город:</span> </td></tr>
		<tr height="230">
		<td colspan="9" height="230">
		<h2>Выберите способ доставки:</h2>
<input type="radio" name="group1" value="Butter" <? if (($_SESSION['calc_tip']==1)) echo " checked";?> onclick="checkc();ajaxUpdateShipping();" class="ggr2"> <span class="hrb">Доставка курьерской службой(Экспресс-доставка).</span><br/><div class="opisr">Сроки доставки рассчитываются индивидуально.<br>Доставка производится курьером лично в руки на указанный клиентом адрес<br/> Для отслеживания передвижения посылки высылается трекинг-номер.</div><? $a=$values['line_subtotal'];;if($a<15000000){ ?>
<div class="gr2"><input type="radio" name="group1" <? if(($_SESSION['calc_tip']==2)) echo " checked";?> value="Milk" onclick="checkc();ajaxUpdateShipping();" class="ggr"> <span class="hrb">Доставка 1 классом почты России(Авиа).</span><br/><div class="opisr">Сроки доставки 7-12 дней.<br>Способ доставки для заказов до 20000 рублей!<br>Клиент получает заказ самостоятельно в своем почтовом отделении.<br/> Для отслеживания передвижения посылки высылается трекинг-номер.</div></div><? }?>
</td> 

		</tr>
<tr><td></td></tr>		
<div class="gd">
		<h3>Выберите город доставки</h3>
		<div>страна</div>
			<div>
		   		<select name="countryid" id="country" onchange="getList('region', 'country')" style="width:300px;font-size:18px;">
		   		    		   		     
		   		    		   		         <option value="245">Армения</option>
		   		    		   		         <option value="248">Беларусь</option>
		   		    		   				  <option value="1894">Казахстан</option>
		   		    		   		       	<option value="3159" selected="selected">Россия</option>
		   		    		   		     </select>
			</div>	
			
			<div>регион</div>
			<div style="display: none" id="loading_region"><img alt="" src="/img/ajax_loader.gif" />Загрузка...</div>
			<div>

		   		<select name="regionid" id="region" onchange="getList('city2', 'region')" style="width:300px;font-size:18px;">
		   		    												<option value="1" selected="selected">Выберите регион...</option>
<option value="1998532">Адыгея</option><option value="3160">Алтайский край</option><option value="3223">Амурская обл.</option><option value="3251">Архангельская обл.</option><option value="3282">Астраханская обл.</option><option value="3296">Башкортостан(Башкирия)</option><option value="3352">Белгородская обл.</option><option value="3371">Брянская обл.</option><option value="3407">Бурятия</option><option value="3437">Владимирская обл.</option><option value="3468">Волгоградская обл.</option><option value="3503">Вологодская обл.</option><option value="3529">Воронежская обл.</option><option value="3630">Дагестан</option><option value="3673">Еврейская обл.</option><option value="3675">Ивановская обл.</option><option value="3703">Иркутская обл.</option><option value="3751">Кабардино-Балкария</option><option value="3761">Калининградская обл.</option><option value="3827">Калмыкия</option><option value="3841">Калужская обл.</option><option value="3872">Камчатская обл.</option><option value="3892">Карелия</option><option value="3921">Кемеровская обл.</option><option value="3952">Кировская обл.</option><option value="3994">Коми</option><option value="4026">Костромская обл.</option><option value="4052">Краснодарский край</option><option value="4105">Красноярский край</option><option value="393939">Крымский Федеральный Округ</option><option value="4176">Курганская обл.</option><option value="4198">Курская обл.</option><option value="4227">Липецкая обл.</option><option value="4243">Магаданская обл.</option><option value="4270">Марий Эл</option><option value="4287">Мордовия</option><option value="4312">Москва и Московская обл.</option><option value="4481">Мурманская обл.</option><option value="3563">Нижегородская (Горьковская)</option><option value="4503">Новгородская обл.</option><option value="4528">Новосибирская обл.</option><option value="4561">Омская обл.</option><option value="4593">Оренбургская обл.</option><option value="4633">Орловская обл.</option><option value="4657">Пензенская обл.</option><option value="4689">Пермская обл.</option><option value="4734">Приморский край</option><option value="4773">Псковская обл.</option><option value="4800">Ростовская обл.</option><option value="4861">Рязанская обл.</option><option value="4891">Самарская обл.</option><option value="4925">Санкт-Петербург и область</option><option value="4969">Саратовская обл.</option><option value="5011">Саха (Якутия)</option><option value="5052">Сахалин</option><option value="5080">Свердловская обл.</option><option value="5151">Северная Осетия</option><option value="5161">Смоленская обл.</option><option value="5191">Ставропольский край</option><option value="5225">Тамбовская обл.</option><option value="5246">Татарстан</option><option value="3784">Тверская обл.</option><option value="5291">Томская обл.</option><option value="5312">Тува (Тувинская Респ.)</option><option value="5326">Тульская обл.</option><option value="5356">Тюменская обл.</option><option value="5404">Удмуртия</option><option value="5432">Ульяновская обл.</option><option value="5458">Уральская обл.</option><option value="5473">Хабаровский край</option><option value="2316497">Хакасия</option><option value="2499002">Ханты-Мансийский АО</option><option value="5507">Челябинская обл.</option><option value="5543">Чечено-Ингушетия</option><option value="5555">Читинская обл.</option><option value="5600">Чувашия</option><option value="2415585">Чукотский АО</option><option value="5019394">Ямало-Ненецкий АО</option><option value="5625">Ярославская обл.</option>

		   		    		   		</select>
			</div>
			<div>Город</div>
			<div style="display: none" id="loading_region"><img alt="" src="/img/ajax_loader.gif" />Загрузка...</div>
			<div>
<select name="city_id" id="city2" style="width:300px;" onchange="javascript:hipping3();" class="city2" style="width:300px;font-size:18px;">
      
			
					</select></div>
</div>	<div id="zakrit"></div>
				<H3>Ваши товары</h3>
		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	</tbody>
</table>



<?php do_action( 'woocommerce_after_cart_table' ); ?>

</form>




<div class="cart-collaterals">


<?php do_action('woocommerce_cart_collaterals'); ?>

<?php woocommerce_cart_totals(); ?>

<?php woocommerce_shipping_calculator(); ?>

	<? if ((!Isset($_SESSION['calc_tip']))){
		?>
		<script>		document.getElementById('gotopay').style.display='none';
</script>
		<?
		
	}
?>
<?  session_start();  if  ($_SESSION['ck']=='on') {?>
<script>
	document.getElementById('zakrit').style.display='none';


</script>
<? }?>	

	<script>

function hipping2(){
		document.getElementById('zakrit').style.display='none';

	<?
	
  session_start();
$_SESSION['ck'] = "on";


?>
	
	hipping();
	

}


</script>

</div>
</div>
<?php do_action( 'woocommerce_after_cart' ); ?>