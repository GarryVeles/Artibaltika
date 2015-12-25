<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;
?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>




<section>
							<header>
								ВАША КОРЗИНА:
							</header>
							
							<?php if ( sizeof( $woocommerce->cart->get_cart() ) == 0 ) : ?>
							
							<div> Корзина пуста </div>
							<?php else: ?>
							
							
							<div>Вы заказали - <?php print sizeof( $woocommerce->cart->get_cart() ); ?> тов.</div>
							<div>Сумма заказа - <?php echo $woocommerce->cart->get_cart_subtotal(); ?></div>
							<div><a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="button"><?php _e( 'View Cart &rarr;', 'woocommerce' ); ?></a></div>
							
							<?php endif; ?>
						</section>




<?php do_action( 'woocommerce_after_mini_cart' ); ?>
