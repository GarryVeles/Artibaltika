<?php
/**
 * Empty cart page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<p><?php _e( 'Your cart is currently empty.', 'woocommerce' ) ?></p>

<?php do_action('woocommerce_cart_is_empty'); ?>
<?
$_SESSION['country']='';
$_SESSION['calc_tip']='';

?>
<p><a class="button" href="<?php print home_url("katalog/?cat_page=1&order_by=size&order=asc"); ?>"><?php print ( '&larr; Вернуться в каталог') ?></a></p>