<?php
/**
 * Customer processing order email
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php do_action('woocommerce_email_header', $email_heading); ?>

<p>Ваш заказ принят.</p>

<p>После обработки вышлем Вам счёт для оплаты.</p>

<p>С уважением,</p>

<p>ООО "РТИ-Балтика"<br />
www.rti-baltika.ru<br />
тел. +7(911)071-91-84</p>

<table cellspacing="0" cellpadding="6" style="width: 100%; border: 1px solid #eee;" border="1" bordercolor="#eee">
	<thead>
		<tr>
			<th class="product-attr">№</th>				<th class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>								<th class="product-attr">Размер</th>				<th class="product-attr">Тип</th>				<th class="product-attr">Кол-во</th>				<th class="product-attr">Ед.</th>								<th class="product-total">Цена</th>				<th class="product-total">Сумма</th>
		</tr>
	</thead>
	<tbody>
		<?php echo $order->email_order_items_table( $order->is_download_permitted(), true, ($order->status=='processing') ? true : false ); ?>
	</tbody>
	<tfoot>
		<?php
			if ( $totals = $order->get_order_item_totals() ) {
				$i = 0;
				foreach ( $totals as $total ) {
					$i++;
					?><tr>
						<th scope="row" colspan="2" style="text-align:left; border: 1px solid #eee; <?php if ( $i == 1 ) echo 'border-top-width: 4px;'; ?>"><?php echo $total['label']; ?></th>
						<td colspan="6" style="text-align:left; border: 1px solid #eee; <?php if ( $i == 1 ) echo 'border-top-width: 4px;'; ?>"><?php echo  str_replace("через Доставка", "", $total['value']); ?></td>
					</tr><?php
				}
			}
		?>
	</tfoot>
</table>


<?php do_action('woocommerce_email_footer'); ?>
