<?php
/**
 * Email Order Items
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     2.0.3
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;
$product_counter = 0;
$totals = wcdn_get_order_totals(); ;$sum=$order->get_order_total();
//var_dump($order);
							$sum=str_replace("руб.",'',$sum); $a = strip_tags($sum); $sum=(int)$a+1-1  ;        // Split the string, using the decimal point as separator
		foreach ($items as $item) :
			$_product = $order->get_product_from_item( $item );
$rrt=$item['item_meta']['_qty'][0];
		$r=$_product->get_price();
		$rr=$rr+$r*$rrt;
					endforeach;
					
					//echo $rr;
foreach ($items as $item) :

	// Get/prep product data
	$_product = $order->get_product_from_item( $item );
	$item_meta = new WC_Order_Item_Meta( $item['item_meta'] );
	$attachment_image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $_product->id ), 'thumbnail' );
	$image = ( $show_image ) ? '<img src="' . current( $attachment_image_src ) . '" alt="Product Image" height="' . $image_size[1] . '" width="' . $image_size[0] . '" style="vertical-align:middle; margin-right: 10px;" />' : '';
	
	?>
							<tr>

							

								<td class = 'number'><?php print ++$product_counter; ?></td>

								<td class="description"><?php echo $item['name']; ?>

									<?php echo $item['meta']; ?>

									<!--<dl class="meta">

										<?php if( !empty( $item['sku'] ) ) : ?><dt><?php _e( 'SKU:', 'woocommerce-delivery-notes' ); ?></dt><dd><?php echo $item['sku']; ?></dd><?php endif; ?>

										<?php if( !empty( $item['weight'] ) ) : ?><dt><?php _e( 'Weight:', 'woocommerce-delivery-notes' ); ?></dt><dd><?php echo $item['weight']; ?><?php echo get_option('woocommerce_weight_unit'); ?></dd><?php endif; ?>

									</dl>-->

								</td>

								<td class = 'size'><?php  print $_product->get_attribute('size')  ?></td>

								<td class = 'type'><?php  print $_product->get_attribute('type')  ?></td>

								<td class="quantity"><?php print $item['item_meta']['_qty'][0]; ?></td>
								
								
								

								<td class="units">шт.</td>

								<td class="single-price"><?php  if ($rr>10000) { $r=$_product->get_price();$r=$r*0.7;
								echo $r;
								}
else {echo $_product->get_price();}								
								?>руб.</td>

								<td class="totals"><?php  print $item['line_total'] ?>руб.</td>

							</tr>

							

							

		
<?php endforeach; ?>