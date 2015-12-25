<?php
if( is_admin() ) {

	/* Start of: WordPress Administration */

	// HTML template for Filter Orders by Date widget on Store Exporter screen
	function woo_cd_orders_filter_by_date() {

		$current_month = date( 'F' );
		$last_month = date( 'F', mktime( 0, 0, 0, date( 'n' )-1, 1, date( 'Y' ) ) );
		$order_dates_from = woo_cd_get_order_first_date();
		$order_dates_to = date( 'd/m/Y' );
		ob_start(); ?>
<p><label><input type="checkbox" id="orders-filters-date" /> <?php _e( 'Filter Orders by Order Date', 'woo_ce' ); ?></label></p>
<div id="export-orders-filters-date" class="separator">
	<ul>
		<li>
			<label><input type="radio" name="order_dates_filter" value="current_month" /> <?php _e( 'Current month', 'woo_ce' ); ?> (<?php echo $current_month; ?>)</label>
		</li>
		<li>
			<label><input type="radio" name="order_dates_filter" value="last_month" /> <?php _e( 'Last month', 'woo_ce' ); ?> (<?php echo $last_month; ?>)</label>
		</li>
<!--
		<li>
			<label><input type="radio" name="order_dates_filter" value="last_quarter" /> <?php _e( 'Last quarter', 'woo_ce' ); ?> (Nov. - Jan.)</label>
		</li>
-->
		<li>
			<label><input type="radio" name="order_dates_filter" value="manual" checked="checked" /> <?php _e( 'Manual', 'woo_ce' ); ?></label>
			<div style="margin-top:0.2em;">
				<input type="text" size="10" maxlength="10" id="order_dates_from" name="order_dates_from" value="<?php echo $order_dates_from; ?>" class="text datepicker" /> to <input type="text" size="10" maxlength="10" id="order_dates_to" name="order_dates_to" value="<?php echo $order_dates_to; ?>" class="text datepicker" />
				<p class="description"><?php _e( 'Filter the dates of Orders to be included in the export. Default is the date of the first order to today.', 'woo_ce' ); ?></p>
			</div>
		</li>
	</ul>
</div>
<!-- #export-orders-filters-date -->
<?php
		ob_end_flush();

	}

	// Returns date of first Order received, any status
	function woo_cd_get_order_first_date() {

		$output = date( 'd/m/Y', mktime( 0, 0, 0, date( 'n' ), 1 ) );
		$post_type = 'shop_order';
		$args = array(
			'post_type' => $post_type,
			'orderby' => 'post_date',
			'order' => 'ASC',
			'numberposts' => 1,
			'cache_results' => false,
			'no_found_rows' => false
		);
		$orders = get_posts( $args );
		if( $orders ) {
			$order = strtotime( $orders[0]->post_date );
			$output = date( 'd/m/Y', $order );
		}
		return $output;

	}

	// HTML template for Filter Orders by Customer widget on Store Exporter screen
	function woo_cd_orders_filter_by_customer() {

		$customers = woo_cd_get_customers_list();
		ob_start(); ?>
<p><label for="order_customer"><?php _e( 'Filter Orders by Customer', 'woo_ce' ); ?></label></p>
<div id="export-orders-filters-customer" class="separator">
	<ul>
		<li>
			<select id="order_customer" name="order_customer" class="chzn-select">
				<option value=""><?php _e( 'Show all customers', 'woo_ce' ); ?></option>
<?php if( $customers ) { ?>
	<?php foreach( $customers as $customer ) { ?>
				<option value="<?php echo $customer->ID; ?>"><?php printf( '%s (#%s - %s)', $customer->display_name, $customer->ID, $customer->user_email ); ?></option>
	<?php } ?>
<?php } ?>
			</select>
		</li>
	</ul>
	<p class="description"><?php _e( 'Filter Orders by Customer (unique e-mail address) to be included in the export. Default is to include all Orders.', 'woo_ce' ); ?></p>
</div>
<!-- #export-orders-filters-customer -->
<?php
		ob_end_flush();

	}

	// HTML template for Filter Orders by User Role widget on Store Exporter screen
	function woo_cd_orders_filter_by_user_role() {

		$user_roles = woo_ce_get_user_roles();
		ob_start(); ?>
<p><label><input type="checkbox" id="orders-filters-user_role" /> <?php _e( 'Filter Orders by User Role', 'woo_ce' ); ?></label></p>
<div id="export-orders-filters-user_role" class="separator">
	<ul>
<?php foreach( $user_roles as $key => $user_role ) { ?>
		<li><label><input type="checkbox" name="order_filter_user_role[<?php echo $key; ?>]" value="<?php echo $key; ?>" /> <?php echo ucfirst( $user_role['name'] ); ?></label></li>
<?php } ?>
	</ul>
	<p class="description"><?php _e( 'Select the User Roles you want to filter exported Orders by. Default is to include all User Role options.', 'woo_ce' ); ?></p>
</div>
<!-- #export-orders-filters-status -->
<?php
		ob_end_flush();

	}

	// HTML template for Order Items Formatting on Store Exporter screen
	function woo_cd_orders_items_formatting() {

		$order_items_formatting = woo_ce_get_option( 'order_items_formatting', 'unique' );
		ob_start(); ?>
<p><label for="order_items"><?php _e( 'Order items formatting', 'woo_ce' ); ?></label></p>
<div id="export-orders-items-formatting" class="separator">
	<ul>
		<li>
			<label><input type="radio" name="order_items" value="combined"<?php checked( $order_items_formatting, 'combined' ); ?> />&nbsp;<?php _e( 'Place Order Items within a grouped single Order row', 'woo_ce' ); ?></label>
			<p class="description"><?php _e( 'For example: <code>Cart Items: SKU</code> cell might contain <code>SPECK-IPHONE|INCASE-NANO|-</code> for 3 Order items within an Order', 'woo_cd' ); ?></p>
		</li>
		<li>
			<label><input type="radio" name="order_items" value="unique"<?php checked( $order_items_formatting, 'unique' ); ?> />&nbsp;<?php _e( 'Place Order Items on individual cells within a single Order row', 'woo_ce' ); ?></label>
			<p class="description"><?php _e( 'For example: <code>Cart Items: SKU</code> would become <code>Cart Item #1: SKU</code> with <codeSPECK-IPHONE</code> for the first Order item within an Order', 'woo_ce' ); ?></p>
		</li>
		<li>
			<label><input type="radio" name="order_items" value="individual"<?php checked( $order_items_formatting, 'individual' ); ?> />&nbsp;<?php _e( 'Place each Order Item within their own Order row', 'woo_ce' ); ?></label>
			<p class="description"><?php _e( 'For example: An Order with 3 Order items will display a single Order item on each row', 'woo_ce' ); ?></p>
		</li>
	</ul>
	<p class="description"><?php _e( 'Choose how you would like Order Items to be presented within Orders.', 'woo_ce' ); ?></p>
</div>
<!-- #export-orders-items-formatting -->
<?php
		ob_end_flush();

	}

	// HTML template for Max Order Items widget on Store Exporter screen
	function woo_cd_orders_max_order_items() {

		$max_size = woo_ce_get_option( 'max_order_items', 10 );
		ob_start(); ?>
<tr>
	<th>
		<label for="max_order_items"><?php _e( 'Max unique Order items', 'woo_ce' ); ?>: </label>
	</th>
	<td>
		<input type="text" id="max_order_items" name="max_order_items" size="3" class="text" value="<?php echo $max_size; ?>" />
		<p class="description"><?php _e( 'Manage the number of Order cart item colums displayed when the \'Place Order Items on individual cells within a single Order row\' Order items formatting option is selected.', 'woo_ce' ); ?></p>
	</td>
</tr>
<?php
		ob_end_flush();

	}

	// HTML template for Filter Orders by Order Status widget on Store Exporter screen
	function woo_cd_orders_filter_by_status() {

		$order_statuses = woo_ce_get_order_statuses();
		ob_start(); ?>
<p><label><input type="checkbox" id="orders-filters-status" /> <?php _e( 'Filter Orders by Order Status', 'woo_ce' ); ?></label></p>
<div id="export-orders-filters-status" class="separator">
	<ul>
<?php foreach( $order_statuses as $order_status ) { ?>
		<li><label><input type="checkbox" name="order_filter_status[<?php echo $order_status->name; ?>]" value="<?php echo $order_status->name; ?>" /> <?php echo ucfirst( $order_status->name ); ?></label></li>
<?php } ?>
	</ul>
	<p class="description"><?php _e( 'Select the Order Status you want to filter exported Orders by. Default is to include all Order Status options.', 'woo_ce' ); ?></p>
</div>
<!-- #export-orders-filters-status -->
<?php
		ob_end_flush();

	}

	// HTML template for Order Sorting widget on Store Exporter screen
	function woo_cd_orders_order_sorting() {

		$orderby = woo_ce_get_option( 'order_orderby', 'ID' );
		$order = woo_ce_get_option( 'order_order', 'ASC' );
		ob_start(); ?>
<p><label><?php _e( 'Order Sorting', 'woo_ce' ); ?></label></p>
<div>
	<select name="order_orderby">
		<option value="ID"<?php selected( 'ID', $orderby ); ?>><?php _e( 'Order ID', 'woo_ce' ); ?></option>
		<option value="title"<?php selected( 'title', $orderby ); ?>><?php _e( 'Order Name', 'woo_ce' ); ?></option>
		<option value="date"<?php selected( 'date', $orderby ); ?>><?php _e( 'Date Created', 'woo_ce' ); ?></option>
		<option value="modified"<?php selected( 'modified', $orderby ); ?>><?php _e( 'Date Modified', 'woo_ce' ); ?></option>
		<option value="rand"<?php selected( 'rand', $orderby ); ?>><?php _e( 'Random', 'woo_ce' ); ?></option>
	</select>
	<select name="order_order">
		<option value="ASC"<?php selected( 'ASC', $order ); ?>><?php _e( 'Ascending', 'woo_ce' ); ?></option>
		<option value="DESC"<?php selected( 'DESC', $order ); ?>><?php _e( 'Descending', 'woo_ce' ); ?></option>
	</select>
	<p class="description"><?php _e( 'Select the sorting of Orders within the exported file. By default this is set to export Orders by Product ID in Desending order.', 'woo_ce' ); ?></p>
</div>
<?php
		ob_end_flush();

	}

	// HTML template for Custom Fields link along quick links list on Store Exporter screen
	function woo_cd_quicklink_custom_fields() {

		ob_start(); ?>
<li>| <a href="#export-orders-custom-fields"><?php _e( 'Custom Fields', 'woo_ce' ); ?></a></li>
<?php
		ob_end_flush();

	}

	// HTML template for jump link to Custom Order Fields within Order Options on Store Exporter screen
	function woo_cd_orders_custom_fields_link() {

		ob_start(); ?>
<div id="export-orders-custom-fields-link" class="separator">
	<p><a href="#export-orders-custom-fields"><?php _e( 'Manage Custom Order Fields', 'woo_cd' ); ?></a></p>
</div><input type="hidden" >
<!-- #export-orders-custom-fields-link -->
<?php
		ob_end_flush();

	}

	// HTML template for Custom Orders widget on Store Exporter screen
	function woo_cd_orders_custom_fields() {

		if( $custom_orders = woo_ce_get_option( 'custom_orders', '' ) )
			$custom_orders = implode( "\n", $custom_orders );
		if( $custom_order_items = woo_ce_get_option( 'custom_order_items', '' ) )
			$custom_order_items = implode( "\n", $custom_order_items );
		ob_start(); ?>
<form method="post" id="export-orders-custom-fields">
	<div id="poststuff">

		<div class="postbox" id="export-options">
			<h3 class="hndle"><?php _e( 'Custom Order Fields', 'woo_ce' ); ?></h3>
			<div class="inside">
				<p class="description"><?php _e( 'To include additional custom Order and Order Item meta in the Export Orders table above fill the Orders and Order Items text box then click Save Custom Fields.', 'woo_ce' ); ?></p>
				<table class="form-table">

					<tr>
						<th>
							<label><?php _e( 'Order Meta', 'woo_ce' ); ?></label>
						</th>
						<td>
							<textarea name="custom_orders" rows="5" cols="70"><?php echo $custom_orders; ?></textarea>
							<p class="description"><?php _e( 'Include additional custom Order meta in your exported CSV by adding each custom Order meta name to a new line above.<br />For example: <code>Customer UA, Customer IP Address</code>', 'woo_ce' ); ?></p>
						</td>
					</tr>

					<tr>
						<th>
							<label><?php _e( 'Order Item Meta', 'woo_ce' ); ?></label>
						</th>
						<td>
							<textarea name="custom_order_items" rows="5" cols="70"><?php echo $custom_order_items; ?></textarea>
							<p class="description"><?php _e( 'Include additional custom Order Item meta in your exported CSV by adding each custom Order Item meta name to a new line above.<br />For example: <code>Personalized Message</code>.', 'woo_ce' ); ?></p>
						</td>
					</tr>

				</table>
				<p class="submit">
					<input type="submit" value="<?php _e( 'Save Custom Fields', 'woo_ce' ); ?>" class="button-primary" />
				</p>
				<p class="description"><?php _e( 'For more information on custom Order and Order Item meta consult our online documentation.', 'woo_ce' ); ?></p>
			</div>
			<!-- .inside -->
		</div>
		<!-- .postbox -->

	</div>
	<input type="hidden" name="action" value="update" />
</form>
<?php
		ob_end_flush();

	}

	/* End of: WordPress Administration */

}

// Adds custom Order and Order Item columns to the Order fields list
function woo_cd_order_fields( $fields = array() ) {

	// Product Addons - http://www.woothemes.com/
	if( class_exists( 'Product_Addon_Admin' ) || class_exists( 'Product_Addon_Display' ) ) {
		$product_addons = woo_cd_get_product_addons();
		if( !empty( $product_addons ) ) {
			foreach( $product_addons as $product_addon ) {
				if( !empty( $product_addon ) ) {
					$fields[] = array(
						'name' => sprintf( 'order_items_product_addon_%s', $product_addon->post_name ),
						'label' => sprintf( __( 'Order Items: %s', 'woo_ce' ), $product_addon->post_title ),
						'default' => 1
					);
				}
			}
		}
		unset( $product_addons, $product_addon );
	}

	// Sequential Order Number Pro - http://www.woothemes.com/products/sequential-order-numbers-pro/
	if( class_exists( 'WC_Seq_Order_Number_Pro' ) ) {
		$fields[] = array(
			'name' => 'order_number',
			'label' => __( 'Order Number', 'woo_ce' ),
			'default' => 1
		);
	}

	// WooCommerce Checkout Manager - http://www.trottyzone.com/product/woocommerce-checkout-manager-pro
	if( function_exists( 'wccs_install' ) ) {
		$options = get_option( 'wccs_settings' );
		if( isset( $options['buttons'] ) ) {
			$buttons = $options['buttons'];
			unset( $options );
			if( !empty( $buttons ) ) {
				foreach( $buttons as $button ) {
					$fields[] = array(
						'name' => $button['label'],
						'label' => $button['label'],
						'default' => 1
					);
				}
				unset( $buttons, $button );
			}
		}
	}

	// Cost of Goods - http://www.skyverge.com/product/woocommerce-cost-of-goods-tracking/
	if( class_exists( 'WC_COG' ) ) {
		$fields[] = array(
			'name' => 'total_cost_of_goods',
			'label' => __( 'Total Cost of Goods', 'woo_ce' ),
			'default' => 1
		);
		$fields[] = array(
			'name' => 'order_items_cost_of_goods',
			'label' => __( 'Order Items: Cost of Goods', 'woo_ce' ),
			'default' => 1
		);
	}

	$custom_orders = woo_ce_get_option( 'custom_orders', '' );
	if( !empty( $custom_orders ) ) {
		foreach( $custom_orders as $custom_order ) {
			if( !empty( $custom_order ) ) {
				$fields[] = array(
					'name' => $custom_order,
					'label' => $custom_order,
					'default' => 1
				);
			}
		}
		unset( $custom_orders, $custom_order );
	}
	return $fields;

}
add_filter( 'woo_ce_order_fields', 'woo_cd_order_fields' );

// Returns a list of Orders
function woo_cd_get_orders( $export_type = 'orders', $args = array() ) {

	global $export;

	$limit_volume = -1;
	$offset = 0;
	if( $args ) {
		$user_roles = $args['order_user_roles'];
		$limit_volume = $args['limit_volume'];
		$offset = $args['offset'];
		$orderby = $args['order_orderby'];
		$order = $args['order_order'];
		switch( $args['order_dates_filter'] ) {

			case 'current_month':
				$order_dates_from = date( 'd-m-Y', mktime( 0, 0, 0, date( 'm' ), 1, date( 'Y' ) ) );
				$order_dates_to = date( 'd-m-Y', mktime( 0, 0, 0, ( date( 'm' ) + 1 ), 0, date( 'Y' ) ) );
				break;

			case 'last_month':
				$order_dates_from = date( 'd-m-Y', mktime( 0, 0, 0, ( date( 'm' ) - 1 ), 1, date( 'Y' ) ) );
				$order_dates_to = date( 'd-m-Y', mktime( 0, 0, 0, date( 'm' ), 0, date( 'Y' ) ) );
				break;

			case 'last_quarter':
				break;

			case 'manual':
				$order_dates_from = $args['order_dates_from'];
				$order_dates_to = $args['order_dates_to'];
				break;

			default:
				$order_dates_from = false;
				$order_dates_to = false;
				break;

		}
		if( $order_dates_from && $order_dates_to ) {
			$order_dates_from = strtotime( $order_dates_from );
			$order_dates_to = explode( '-', $order_dates_to );
			$order_dates_to = strtotime( date( 'd-m-Y', mktime( 0, 0, 0, $order_dates_to[1], $order_dates_to[0]+1, $order_dates_to[2] ) ) );
		}
		$order_status = $args['order_status'];
		$user_id = $args['order_customer'];
		$order_items = $args['order_items'];
	}
	$post_type = 'shop_order';
	$args = array(
		'post_type' => $post_type,
		'orderby' => $orderby,
		'order' => $order,
		'numberposts' => $limit_volume,
		'offset' => $offset,
		'post_status' => woo_ce_post_statuses(),
		'cache_results' => false,
		'no_found_rows' => false
	);
	if( !empty( $order_status ) ) {
		$term_taxonomy = 'shop_order_status';
		$args['tax_query'] = array(
			array(
				'taxonomy' => $term_taxonomy,
				'field' => 'slug',
				'terms' => $order_status
			)
		);
	}
	if( !empty( $user_id ) ) {
		if( $user = get_userdata( $user_id ) ) {
			$args['meta_key'] = '_billing_email';
			$args['meta_value'] = $user->user_email;
		}
	}
	$export->total_rows = 0;
	if( $orders = get_posts( $args ) ) {
		$export->total_rows = count( $orders );
		foreach( $orders as $key => $order ) {
			// $order = woo_cd_get_order_data( $order );
			// Filter Order dates by dropping those outside the date range
			if( $order_dates_from && $order_dates_to ) {
				if( ( strtotime( $order->post_date ) > $order_dates_from ) && ( strtotime( $order->post_date ) < $order_dates_to ) ) {
					// Do nothing
				} else {
					unset( $orders[$key] );
					continue;
				}
			}
			$orders[$key]->user_id = get_post_meta( $order->ID, '_customer_user', true );
			// Filter Orders by User Roles
			if( $user_roles ) {
				$user_ids = array();
				$size = count( $export->args['order_user_roles'] );
				for( $i = 0; $i < $size; $i++ ) {
					$args = array(
						'role' => $export->args['order_user_roles'][$i],
						'fields' => 'ID'
					);
					$user_id = get_users( $args );
					$user_ids = array_merge( $user_ids, $user_id );
				}
				if( !in_array( $orders[$key]->user_id, $user_ids ) ) {
					unset( $orders[$key] );
					continue;
				}
			}
			$orders[$key]->purchase_total = get_post_meta( $order->ID, '_order_total', true );
			$orders[$key]->payment_status = woo_cd_get_order_status( $order->ID );
			if( $orders[$key]->user_id == 0 )
				$orders[$key]->user_id = '';
			$orders[$key]->user_name = woo_cd_get_username( $orders[$key]->user_id );
			$orders[$key]->user_role = woo_ce_format_user_role_label( woo_cd_get_user_role( $orders[$key]->user_id ) );
			$orders[$key]->billing_first_name = get_post_meta( $order->ID, '_billing_first_name', true );
			$orders[$key]->billing_last_name = get_post_meta( $order->ID, '_billing_last_name', true );
			if( empty( $orders[$key]->billing_first_name ) && empty( $orders[$key]->billing_first_name ) )
				$orders[$key]->billing_full_name = '';
			else
				$orders[$key]->billing_full_name = $orders[$key]->billing_first_name . ' ' . $orders[$key]->billing_last_name;
			$orders[$key]->billing_company = get_post_meta( $order->ID, '_billing_company', true );
			$orders[$key]->billing_address = get_post_meta( $order->ID, '_billing_address_1', true );
			$orders[$key]->billing_address_alt = get_post_meta( $order->ID, '_billing_address_2', true );
			if( $orders[$key]->billing_address_alt )
				$orders[$key]->billing_address .= ' ' . $orders[$key]->billing_address_alt;
			$orders[$key]->billing_city = get_post_meta( $order->ID, '_billing_city', true );
			$orders[$key]->billing_postcode = get_post_meta( $order->ID, '_billing_postcode', true );
			$orders[$key]->billing_state = get_post_meta( $order->ID, '_billing_state', true );
			$orders[$key]->billing_country = get_post_meta( $order->ID, '_billing_country', true );
			$orders[$key]->billing_state_full = woo_ce_expand_state_name( $orders[$key]->billing_country, $orders[$key]->billing_state );
			$orders[$key]->billing_country_full = woo_ce_expand_country_name( $orders[$key]->billing_country );
			$orders[$key]->billing_phone = get_post_meta( $order->ID, '_billing_phone', true );
			$orders[$key]->billing_email = get_post_meta( $order->ID, '_billing_email', true );
			$orders[$key]->shipping_first_name = get_post_meta( $order->ID, '_shipping_first_name', true );
			$orders[$key]->shipping_last_name = get_post_meta( $order->ID, '_shipping_last_name', true );
			if( empty( $orders[$key]->shipping_first_name ) && empty( $orders[$key]->shipping_first_name ) )
				$orders[$key]->shipping_full_name = '';
			else
				$orders[$key]->shipping_full_name = $orders[$key]->shipping_first_name . ' ' . $orders[$key]->shipping_last_name;
			$orders[$key]->shipping_company = get_post_meta( $order->ID, '_shipping_company', true );
			$orders[$key]->shipping_address = get_post_meta( $order->ID, '_shipping_address_1', true );
			$orders[$key]->shipping_address_alt = get_post_meta( $order->ID, '_shipping_address_2', true );
			if( $orders[$key]->shipping_address_alt )
				$orders[$key]->shipping_address .= ' ' . $orders[$key]->shipping_address_alt;
			$orders[$key]->shipping_city = get_post_meta( $order->ID, '_shipping_city', true );
			$orders[$key]->shipping_postcode = get_post_meta( $order->ID, '_shipping_postcode', true );
			$orders[$key]->shipping_state = get_post_meta( $order->ID, '_shipping_state', true );
			$orders[$key]->shipping_country = get_post_meta( $order->ID, '_shipping_country', true );
			$orders[$key]->shipping_state_full = woo_ce_expand_state_name( $orders[$key]->shipping_country, $orders[$key]->shipping_state );
			$orders[$key]->shipping_country_full = woo_ce_expand_country_name( $orders[$key]->shipping_country );
			$orders[$key]->shipping_phone = get_post_meta( $order->ID, '_shipping_phone', true );
			if( $export_type == 'orders' ) {
				$orders[$key]->purchase_id = $order->ID;
				$orders[$key]->order_discount = get_post_meta( $order->ID, '_order_discount', true );
				$orders[$key]->order_sales_tax = get_post_meta( $order->ID, '_order_tax', true );
				$orders[$key]->order_shipping_tax = get_post_meta( $order->ID, '_order_shipping_tax', true );
				$orders[$key]->order_excl_tax = ( $orders[$key]->purchase_total - ( $orders[$key]->order_sales_tax - $orders[$key]->order_shipping_tax ) );
				$orders[$key]->payment_status = woo_cd_format_order_status( $orders[$key]->payment_status );
				$orders[$key]->payment_gateway_id = get_post_meta( $order->ID, '_payment_method', true );
				$orders[$key]->payment_gateway = woo_cd_format_order_payment_gateway( $orders[$key]->payment_gateway_id );
				$orders[$key]->shipping_method_id = get_post_meta( $order->ID, '_shipping_method', true );
				$orders[$key]->shipping_method = woo_cd_format_shipping_method( $orders[$key]->shipping_method_id );
				$orders[$key]->shipping_cost = get_post_meta( $order->ID, '_order_shipping', true );
				$orders[$key]->order_key = get_post_meta( $order->ID, '_order_key', true );
				$orders[$key]->purchase_date = woo_ce_format_date( $order->post_date );
				$orders[$key]->purchase_time = mysql2date( 'H:i:s', $order->post_date );
				$orders[$key]->customer_note = $order->post_excerpt;
				$orders[$key]->ip_address = get_post_meta( $order->ID, '_customer_ip_address', true );
				$orders[$key]->browser_agent = get_post_meta( $order->ID, '_customer_user_agent', true );
				$orders[$key]->order_notes = '';
				if( $order_notes = woo_cd_get_order_assoc_notes( $order->ID ) ) {
					foreach( $order_notes as $order_note )
						$orders[$key]->order_notes .= $order_note->comment_content . $export->category_separator;
					$orders[$key]->order_notes = substr( $orders[$key]->order_notes, 0, -1 );
					unset( $order_notes );
				}
				$orders[$key]->order_items_size = 0;
				if( $orders[$key]->order_items = woo_cd_get_order_items( $order->ID ) ) {
					$orders[$key]->order_items_size = count( $orders[$key]->order_items );
					if( $order_items == 'combined' ) {
						$orders[$key]->order_items_product_id = '';
						$orders[$key]->order_items_variation_id = '';
						$orders[$key]->order_items_sku = '';
						$orders[$key]->order_items_name = '';
						$orders[$key]->order_items_variation = '';
						$orders[$key]->order_items_tax_class = '';
						$orders[$key]->order_items_quantity = '';
						$orders[$key]->order_items_total = '';
						$orders[$key]->order_items_subtotal = '';
						$orders[$key]->order_items_tax = '';
						$orders[$key]->order_items_tax_subtotal = '';
						$orders[$key]->order_items_type = '';
						$orders[$key]->order_items_category = '';
						$orders[$key]->order_items_tag = '';
						foreach( $orders[$key]->order_items as $order_item ) {
							if( empty( $order_item->sku ) )
								$order_item->sku = '-';
							$orders[$key]->order_items_product_id .= $order_item->product_id . $export->category_separator;
							$orders[$key]->order_items_variation_id .= $order_item->variation_id . $export->category_separator;
							$orders[$key]->order_items_sku .= $order_item->sku . $export->category_separator;
							$orders[$key]->order_items_name .= $order_item->name . $export->category_separator;
							$orders[$key]->order_items_variation .= $order_item->variation . $export->category_separator;
							$orders[$key]->order_items_tax_class .= $order_item->tax_class . $export->category_separator;
							if( empty( $order_item->quantity ) && '0' != $order_item->quantity )
								$order_item->quantity = '-';
							$orders[$key]->order_items_quantity .= $order_item->quantity . $export->category_separator;
							$orders[$key]->order_items_total .= $order_item->total . $export->category_separator;
							$orders[$key]->order_items_subtotal .= $order_item->subtotal . $export->category_separator;
							$orders[$key]->order_items_tax .= $order_item->tax . $export->category_separator;
							$orders[$key]->order_items_tax_subtotal .= $order_item->tax_subtotal . $export->category_separator;
							$orders[$key]->order_items_type .= $order_item->type . $export->category_separator;
							$orders[$key]->order_items_category .= $order_item->category . $export->category_separator;
							$orders[$key]->order_items_tag .= $order_item->tag . $export->category_separator;
						}
						$orders[$key]->order_items_product_id = substr( $orders[$key]->order_items_product_id, 0, -1 );
						$orders[$key]->order_items_variation_id = substr( $orders[$key]->order_items_variation_id, 0, -1 );
						$orders[$key]->order_items_sku = substr( $orders[$key]->order_items_sku, 0, -1 );
						$orders[$key]->order_items_name = substr( $orders[$key]->order_items_name, 0, -1 );
						$orders[$key]->order_items_variation = substr( $orders[$key]->order_items_variation, 0, -1 );
						$orders[$key]->order_items_tax_class = substr( $orders[$key]->order_items_tax_class, 0, -1 );
						$orders[$key]->order_items_quantity = substr( $orders[$key]->order_items_quantity, 0, -1 );
						$orders[$key]->order_items_total = substr( $orders[$key]->order_items_total, 0, -1 );
						$orders[$key]->order_items_subtotal = substr( $orders[$key]->order_items_subtotal, 0, -1 );
						$orders[$key]->order_items_type = substr( $orders[$key]->order_items_type, 0, -1 );
						$orders[$key]->order_items_category = substr( $orders[$key]->order_items_category, 0, -1 );
						$orders[$key]->order_items_tag = substr( $orders[$key]->order_items_tag, 0, -1 );
						$orders[$key] = apply_filters( 'woo_cd_order_items_combined', $orders[$key] );
					} else if( $order_items == 'unique' ) {
						$i = 1;
						foreach( $orders[$key]->order_items as $order_item ) {
							if( empty( $order_item->sku ) )
								$order_item->sku = '-';
							$orders[$key]->{sprintf( 'order_item_%d_product_id', $i )} = $order_item->product_id;
							$orders[$key]->{sprintf( 'order_item_%d_variation_id', $i )} = $order_item->variation_id;
							$orders[$key]->{sprintf( 'order_item_%d_sku', $i )} = $order_item->sku;
							$orders[$key]->{sprintf( 'order_item_%d_name', $i )} = $order_item->name;
							$orders[$key]->{sprintf( 'order_item_%d_variation', $i )} = $order_item->variation;
							$orders[$key]->{sprintf( 'order_item_%d_tax_class', $i )} = $order_item->tax_class;
							if( empty( $order_item->quantity ) && '0' != $order_item->quantity )
								$order_item->quantity = '-';
							$orders[$key]->{sprintf( 'order_item_%d_quantity', $i )} = $order_item->quantity;
							$orders[$key]->{sprintf( 'order_item_%d_total', $i )} = $order_item->total;
							$orders[$key]->{sprintf( 'order_item_%d_subtotal', $i )} = $order_item->subtotal;
							$orders[$key]->{sprintf( 'order_item_%d_tax', $i )} = $order_item->tax;
							$orders[$key]->{sprintf( 'order_item_%d_tax_subtotal', $i )} = $order_item->tax_subtotal;
							$orders[$key]->{sprintf( 'order_item_%d_type', $i )} = $order_item->type;
							$orders[$key]->{sprintf( 'order_item_%d_category', $i )} = $order_item->category;
							$orders[$key]->{sprintf( 'order_item_%d_tag', $i )} = $order_item->tag;
							$orders[$key] = apply_filters( 'woo_cd_order_items_unique', $orders[$key], $i, $order_item );
							$i++;
						}
					}

					// Custom
					$custom_order_items = woo_ce_get_option( 'custom_order_items', '' );
					if( !empty( $custom_order_items ) ) {
						foreach( $custom_order_items as $custom_order_item ) {
							if( !empty( $custom_order_item ) )
								$orders[$key]->{$custom_order_item} = get_post_meta( $order->ID, $custom_order_item, true );
						}
					}
					$custom_orders = woo_ce_get_option( 'custom_orders', '' );
					if( !empty( $custom_orders ) ) {
						foreach( $custom_orders as $custom_order ) {
							if( !empty( $custom_order ) )
								$orders[$key]->{$custom_order} = get_post_meta( $order->ID, $custom_order, true );
						}
					}
				}
				$orders[$key] = apply_filters( 'woo_cd_order', $orders[$key] );
			}
		}
	}
	if( $export_type == 'customers' ) {
		$customers = array();
		foreach( $orders as $order ) {
			if( $duplicate_key = woo_cd_is_duplicate_customer( $customers, $order ) ) {
				$customers[$duplicate_key]->total_spent = $customers[$duplicate_key]->total_spent + $order->purchase_total;
				$customers[$duplicate_key]->total_orders++;
				if( $order->payment_status == 'completed' )
					$customers[$duplicate_key]->completed_orders++;
			} else {
				$customers[$order->ID] = $order;
				$customers[$order->ID]->total_spent = $order->purchase_total;
				$customers[$order->ID]->completed_orders = 0;
				if( $order->payment_status == 'completed' )
					$customers[$order->ID]->completed_orders = 1;
				$customers[$order->ID]->total_orders = 1;
			}
		}
		$export->total_rows = count( $customers );
		return $customers;
	} else {
		return $orders;
	}

}

// Returns Order data associated to a specific Order
function woo_cd_get_order_data( $order ) {

	// $order = wp_parse_args( $order, new WC_Order( $order->ID ) );
	return $order;

}

// Returns Order Notes associated to a specific Order
function woo_cd_get_order_assoc_notes( $order_id = 0 ) {

	global $wpdb;

	if( $order_id ) {
		$term_taxonomy = 'order_note';
		// The default get_comments() call is not working for returning Order Notes, using database query in interim
/*
		$args = array(
			'comment_type' => $term_taxonomy,
			'post_id' => $order_id,
			'status' => 'approve'
		);
		$order_notes = get_comments( $args );
*/
		$order_notes_sql = $wpdb->prepare( "SELECT * FROM " . $wpdb->comments . " WHERE `comment_type` = '%s' AND `comment_post_ID` = %d AND `comment_author` = 'WooCommerce' AND `comment_approved` = 1", $order_id );
		$order_notes = $wpdb->get_results( $order_notes_sql );
		$wpdb->flush();
		return $order_notes;
	}
	return $output;

}

function woo_cd_max_order_items( $orders = array() ) {

	$output = 0;
	if( $orders ) {
		foreach( $orders as $order ) {
			if( $order->order_items )
				$output = count( $order->order_items[0]->name );
		}
	}
	return $output;

}

// Returns a list of Order Items for a specified Order
function woo_cd_get_order_items( $order_id = 0 ) {

	global $export, $wpdb;

	if( $order_id ) {
		$order_items_sql = $wpdb->prepare( "SELECT `order_item_id` as id, `order_item_name` as name, `order_item_type` as type FROM `" . $wpdb->prefix . "woocommerce_order_items` WHERE `order_id` = %d", $order_id );
		if( $order_items = $wpdb->get_results( $order_items_sql ) ) {
			$wpdb->flush();
			foreach( $order_items as $key => $order_item ) {
				$order_item_meta_sql = $wpdb->prepare( "SELECT `meta_key`, `meta_value` FROM `" . $wpdb->prefix . "woocommerce_order_itemmeta` WHERE `order_item_id` = %d", $order_item->id );
				if( $order_item_meta = $wpdb->get_results( $order_item_meta_sql ) ) {
					$order_items[$key]->product_id = '';
					$order_items[$key]->variation_id = '';
					$order_items[$key]->variation = '';
					$order_items[$key]->quantity = '';
					$order_items[$key]->total = '';
					$order_items[$key]->subtotal = '';
					$order_items[$key]->tax = '';
					$order_items[$key]->tax_subtotal = '';
					$order_items[$key]->tax_class = '';
					$order_items[$key]->category = '';
					$order_items[$key]->tag = '';
					$size = count( $order_item_meta );
					for( $i = 0; $i < $size; $i++ ) {
						switch( $order_item_meta[$i]->meta_key ) {

							case '_qty':
								$order_items[$key]->quantity = $order_item_meta[$i]->meta_value;
								break;

							case '_product_id':
								if( $order_items[$key]->product_id = $order_item_meta[$i]->meta_value ) {
									$order_items[$key]->sku = get_post_meta( $order_items[$key]->product_id, '_sku', true );
									$order_items[$key]->category = woo_ce_get_product_assoc_categories( $order_items[$key]->product_id );
									$order_items[$key]->tag = woo_ce_get_product_assoc_tags( $order_items[$key]->product_id );
								}
								break;

							case '_tax_class':
								$order_items[$key]->tax_class = get_post_meta( $order_items[$key]->product_id, 'size', true );
								break;

							case '_line_subtotal':
								$order_items[$key]->subtotal = $order_item_meta[$i]->meta_value;
								break;

							case '_line_subtotal_tax':
								$order_items[$key]->tax_subtotal = $order_item_meta[$i]->meta_value;
								break;

							case '_line_total':
								$order_items[$key]->total = $order_item_meta[$i]->meta_value;
								break;

							case '_line_tax':
								$order_items[$key]->tax = $order_item_meta[$i]->meta_value;
								break;

							case '_variation_id':
								$order_items[$key]->variation = '';
								if( $order_items[$key]->variation_id = $order_item_meta[$i]->meta_value ) {
									$order_items[$key]->sku = get_post_meta( $order_items[$key]->variation_id, '_sku', true );
									$variations_sql = "SELECT `meta_key` FROM `" . $wpdb->postmeta . "` WHERE `post_id` = " . (int)$order_items[$key]->variation_id . " AND `meta_key` LIKE 'attribute_pa_%'";
									if( $variations = $wpdb->get_col( $variations_sql ) ) {
										foreach( $variations as $variation ) {
											$variation = str_replace( 'attribute_pa_', '', $variation );
											$variation_label_sql = $wpdb->prepare( "SELECT `attribute_label` FROM `" . $wpdb->prefix . "woocommerce_attribute_taxonomies` WHERE `attribute_name` = '%s' LIMIT 1", $variation );
											$variation_label = $wpdb->get_var( $variation_label_sql );
											$slug = get_post_meta( $order_items[$key]->variation_id, sprintf( 'attribute_pa_%s', $variation ), true );
											$term_taxonomy = 'pa_' . $variation;
											if( taxonomy_exists( $term_taxonomy ) ) {
												$term = get_term_by( 'slug', $slug, $term_taxonomy );
												if( $term )
													$order_items[$key]->variation .= sprintf( '%s: %s', $variation_label, $term->name ) . $export->category_separator;
											}
										}
										$order_items[$key]->variation = substr( $order_items[$key]->variation, 0, -1 );
									}
								}
								break;

							default:
								$order_items[$key] = apply_filters( 'woo_cd_order_items', $order_items[$key], $order_item_meta[$i]->meta_key, $order_item_meta[$i]->meta_value );
								break;

						}
					}
				}
				unset( $order_item_meta );
				if( $order_items[$key]->type == 'fee' )
					$order_items[$key]->quantity = 1;
				$order_items[$key]->type = woo_cd_format_order_item_type( $order_items[$key]->type );
			}
			return $order_items;
		}
	}

}

// Product Add Ons integration
function woo_cd_order_items_product_addons( $order_item, $meta_key = '', $meta_value = '' ) {

	// Product Addons - http://www.woothemes.com/
	if( $product_addons = woo_cd_get_product_addons() ) {
		foreach( $product_addons as $product_addon ) {
			if( strpos( $meta_key, $product_addon->post_name ) !== false ) {
				$order_item->product_addons[$product_addon->post_name] = $meta_value;
			}
		}
	}
	return $order_item;

}
add_filter( 'woo_cd_order_items', 'woo_cd_order_items_product_addons', 10, 3 );

function woo_cd_order_items_product_addons_fields_exclusion( $fields = array() ) {

	// Product Addons - http://www.woothemes.com/
	if( $product_addons = woo_cd_get_product_addons() ) {
		foreach( $product_addons as $product_addon )
			$fields[] = sprintf( 'order_items_product_addon_%s', $product_addon->post_name );
	}
	return $fields;

}
add_filter( 'woo_cd_add_unique_order_item_fields_exclusion', 'woo_cd_order_items_product_addons_fields_exclusion' );

// Order items formatting: Combined
function woo_cd_order_items_extend_combined( $order ) {

	global $export;

	// Product Addons - http://www.woothemes.com/
	if( $product_addons = woo_cd_get_product_addons() ) {
		foreach( $product_addons as $product_addon ) {
			if( $order->order_items ) {
				foreach( $order->order_items as $order_item ) {
					if( isset( $order_item->product_addons[$product_addon->post_name] ) )
						$order->{'order_items_product_addon_' . $product_addon->post_name} = $order_item->product_addons[$product_addon->post_name] . $export->category_separator;
				}
			}
			if( isset( $order->{'order_items_product_addon_' . $product_addon->post_name} ) )
				$order->{'order_items_product_addon_' . $product_addon->post_name} = substr( $order->{'order_items_product_addon_' . $product_addon->post_name}, 0, -1 );
		}
	}
	// Cost of Goods - http://www.skyverge.com/product/woocommerce-cost-of-goods-tracking/
	if( class_exists( 'WC_COG' ) ) {
		if( $order->order_items ) {
			$meta_type = 'order_item';
			foreach( $order->order_items as $order_item )
				$order->order_items_cost_of_goods = get_metadata( $meta_type, $order_item->id, '_wc_cog_item_total_cost', true ) . $export->category_separator;
			if( isset( $order->order_items_cost_of_goods ) )
				$order->order_items_cost_of_goods = substr( $order->order_items_cost_of_goods, 0, -1 );
		}
	}
	return $order;

}
add_filter( 'woo_cd_order_items_combined', 'woo_cd_order_items_extend_combined' );

// Returns list of Product Addon columns
function woo_cd_get_product_addons() {

	$output = array();
	// Product Addons - http://www.woothemes.com/
	if( class_exists( 'Product_Addon_Admin' ) || class_exists( 'Product_Addon_Display' ) ) {
		$post_type = 'global_product_addon';
		$args = array(
			'post_type' => $post_type,
			'numberposts' => -1,
			'cache_results' => false,
			'no_found_rows' => false
		);
		if( $product_addons = get_posts( $args ) ) {
			foreach( $product_addons as $product_addon ) {
				if( $meta = maybe_unserialize( get_post_meta( $product_addon->ID, '_product_addons', true ) ) ) {
					$size = count( $meta );
					for( $i = 0; $i < $size; $i++ ) {
						$output[] = (object)array(
							'post_name' => $meta[$i]['name'],
							'post_title' => $meta[$i]['name']
						);
					}
				}
			}
		}
	}
	// Custom Order Items
	if( $custom_order_items = woo_ce_get_option( 'custom_order_items', '' ) ) {
		foreach( $custom_order_items as $custom_order_item ) {
			$output[] = (object)array(
				'post_name' => $custom_order_item,
				'post_title' => $custom_order_item
			);
		}
	}
	return $output;

}

function woo_cd_order_items_product_addons_fields_on( $fields = array(), $i = 0 ) {

	// Product Addons - http://www.woothemes.com/
	if( $product_addons = woo_cd_get_product_addons() ) {
		foreach( $product_addons as $product_addon )
			$fields[sprintf( 'order_item_%d_product_addon_%s', $i, $product_addon->post_name )] = 'on';
	}
	return $fields;

}
add_filter( 'woo_cd_add_unique_order_item_fields_on', 'woo_cd_order_items_product_addons_fields_on', 10, 2 );

function woo_cd_order_items_product_addons_columns( $fields = array(), $i = 0 ) {

	// Product Addons - http://www.woothemes.com/
	if( $product_addons = woo_cd_get_product_addons() ) {
		foreach( $product_addons as $product_addon )
			$fields[] = sprintf( __( 'Cart Item #%d: %s', 'woo_cd' ), $i, $product_addon->post_title );
	}
	return $fields;

}
add_filter( 'woo_cd_add_unique_order_item_columns', 'woo_cd_order_items_product_addons_columns', 10, 2 );

function woo_cd_order_items_product_addon_unique( $order, $i = 0, $order_item = array() ) {

	// Product Addons - http://www.woothemes.com/
	if( $product_addons = woo_cd_get_product_addons() ) {
		foreach( $product_addons as $product_addon ) {
			if( isset( $order_item->product_addons[$product_addon->post_name] ) )
				$order->{sprintf( 'order_item_%d_product_addon_%s', $i, $product_addon->post_name )} = $order_item->product_addons[$product_addon->post_name];
		}
	}
	// Cost of Goods - http://www.skyverge.com/product/woocommerce-cost-of-goods-tracking/
	if( class_exists( 'WC_COG' ) )
		$order->{sprintf( 'order_item_%d_cost_of_goods', $i )} = $order_item->cost_of_goods;
	return $order;

}
add_filter( 'woo_cd_order_items_unique', 'woo_cd_order_items_product_addon_unique', 10, 3 );

// Order items formatting: Individual
function woo_cd_order_items_product_addon_individual( $order, $order_item ) {

	// Product Addons - http://www.woothemes.com/
	if( $product_addons = woo_cd_get_product_addons() ) {
		foreach( $product_addons as $product_addon ) {
			if( isset( $order_item->product_addons[$product_addon->post_name] ) )
				$order->{'order_items_product_addon_' . $product_addon->post_name} = $order_item->product_addons[$product_addon->post_name];
		}
	}
	return $order;

}
add_filter( 'woo_cd_order_items_individual', 'woo_cd_order_items_product_addon_individual', 10, 2 );

// Order items formatting: Unique
function woo_cd_add_unique_order_item_fields( $fields = array() ) {

	$max_size = woo_ce_get_option( 'max_order_items', 10 );
	if( $fields ) {
		foreach( $fields as $key => $field ) {
			$excluded_fields = apply_filters( 'woo_cd_add_unique_order_item_fields_exclusion', array(
				'order_items_product_id',
				'order_items_variation_id',
				'order_items_sku',
				'order_items_name',
				'order_items_variation',
				'order_items_tax_class',
				'order_items_quantity',
				'order_items_total',
				'order_items_subtotal',
				'order_items_tax',
				'order_items_tax_subtotal',
				'order_items_type',
				'order_items_category',
				'order_items_tag'
			) );
			if( in_array( $key, $excluded_fields ) )
				unset( $fields[$key] );
		}
		for( $i = 1; $i < $max_size; $i++ ) {
			$fields[sprintf( 'order_item_%d_product_id', $i )] = 'on';
			$fields[sprintf( 'order_item_%d_variation_id', $i )] = 'on';
			$fields[sprintf( 'order_item_%d_sku', $i )] = 'on';
			$fields[sprintf( 'order_item_%d_name', $i )] = 'on';
			$fields[sprintf( 'order_item_%d_variation', $i )] = 'on';
			$fields[sprintf( 'order_item_%d_tax_class', $i )] = 'on';
			$fields[sprintf( 'order_item_%d_quantity', $i )] = 'on';
			$fields[sprintf( 'order_item_%d_total', $i )] = 'on';
			$fields[sprintf( 'order_item_%d_subtotal', $i )] = 'on';
			$fields[sprintf( 'order_item_%d_tax', $i )] = 'on';
			$fields[sprintf( 'order_item_%d_tax_subtotal', $i )] = 'on';
			$fields[sprintf( 'order_item_%d_type', $i )] = 'on';
			$fields[sprintf( 'order_item_%d_category', $i )] = 'on';
			$fields[sprintf( 'order_item_%d_tag', $i )] = 'on';
			$fields = apply_filters( 'woo_cd_add_unique_order_item_fields_on', $fields, $i );
		}
	}
	return $fields;

}

function woo_cd_add_unique_order_item_columns( $fields = array() ) {

	$max_size = woo_ce_get_option( 'max_order_items', 10 );
	if( $fields ) {
		foreach( $fields as $key => $field ) {
			if( strpos( $field, 'Order Items' ) !== false )
				unset( $fields[$key] );
		}
		for( $i = 1; $i < $max_size; $i++ ) {
			$fields[] = sprintf( __( 'Cart Item #%d: Product ID', 'woo_cd' ), $i );
			$fields[] = sprintf( __( 'Cart Item #%d: Variation ID', 'woo_cd' ), $i );
			$fields[] = sprintf( __( 'Cart Item #%d: SKU', 'woo_cd' ), $i );
			$fields[] = sprintf( __( 'Cart Item #%d: Product Name', 'woo_cd' ), $i );
			$fields[] = sprintf( __( 'Cart Item #%d: Product Variation', 'woo_cd' ), $i );
			$fields[] = sprintf( __( 'Cart Item #%d: Tax Class', 'woo_cd' ), $i );
			$fields[] = sprintf( __( 'Cart Item #%d: Quantity', 'woo_cd' ), $i );
			$fields[] = sprintf( __( 'Cart Item #%d: Total', 'woo_cd' ), $i );
			$fields[] = sprintf( __( 'Cart Item #%d: Subtotal', 'woo_cd' ), $i );
			$fields[] = sprintf( __( 'Cart Item #%d: Tax', 'woo_cd' ), $i );
			$fields[] = sprintf( __( 'Cart Item #%d: Tax Subtotal', 'woo_cd' ), $i );
			$fields[] = sprintf( __( 'Cart Item #%d: Type', 'woo_cd' ), $i );
			$fields[] = sprintf( __( 'Cart Item #%d: Category', 'woo_cd' ), $i );
			$fields[] = sprintf( __( 'Cart Item #%d: Tag', 'woo_cd' ), $i );
			$fields = apply_filters( 'woo_cd_add_unique_order_item_columns', $fields, $i );
		}
	}
	return $fields;

}

function woo_cd_order_woo_seq( $order ) {

	if( class_exists( 'WC_Seq_Order_Number_Pro' ) )
		$order->order_number = get_post_meta( $order->ID, '_order_number_formatted', true );
	if( class_exists( 'WC_COG' ) )
		$order->total_cost_of_goods = get_post_meta( $order->ID, '_wc_cog_order_total_cost', true );
	return $order;

}
add_filter( 'woo_cd_order', 'woo_cd_order_woo_seq' );

function woo_cd_get_order_status( $order_id = 0 ) {

	global $export;

	$output = '';
	$term_taxonomy = 'shop_order_status';
	if( $status = wp_get_object_terms( $order_id, $term_taxonomy ) ) {
		$size = count( $status );
		for( $i = 0; $i < $size; $i++ ) {
			if( $term = get_term( $status[$i]->term_id, $term_taxonomy ) ) {
				$output .= $term->name . $export->category_separator;
				unset( $term );
			}
		}
		$output = substr( $output, 0, -1 );
	}
	return $output;

}
?>