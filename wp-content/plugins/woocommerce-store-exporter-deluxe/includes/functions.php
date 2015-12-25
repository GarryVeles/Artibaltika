<?php
include_once( WOO_CD_PATH . 'includes/functions-products.php' );
include_once( WOO_CD_PATH . 'includes/functions-orders.php' );
include_once( WOO_CD_PATH . 'includes/functions-coupons.php' );
include_once( WOO_CD_PATH . 'includes/functions-customers.php' );

if( is_admin() ) {

	/* Start of: WordPress Administration */

	// Detect Store Exporter and other platform versions
	function woo_cd_detect_ce() {

		if( !function_exists( 'woo_ce_admin_init' ) ) {
			$woo_ce_url = 'http://wordpress.org/plugins/woocommerce-exporter/';
			$message = '<strong>' . sprintf( __( 'Thank you for installing Store Exporter Deluxe, don\'t forget you must install <a href="%s" target="_blank">Store Exporter</a> too!', 'woo_cd' ), $woo_ce_url ) . '</strong>';
			woo_cd_admin_notice( $message, '', 'plugins.php' );
		}
		$troubleshooting_url = 'http://www.visser.com.au/documentation/store-exporter-deluxe/usage/';
		if( !woo_is_woo_activated() && ( woo_is_wpsc_activated() || woo_is_jigo_activated() ) ) {
			$message = '<strong>' . __( 'We have detected another e-Commerce Plugin than WooCommerce activated, please check that you are using Store Exporter Deluxe for the correct platform.', 'woo_cd' ) . '<a href="' . $troubleshooting_url . '" target="_blank">' . __( 'Need help?', 'woo_cd' ) . '</a></strong>';
			woo_cd_admin_notice( $message, 'error', 'plugins.php' );
		} else if( !woo_is_woo_activated() ) {
			$message = '<strong>' . __( 'We have been unable to detect the WooCommerce Plugin activated on this WordPress site, please check that you are using Store Exporter Deluxe for the correct platform.', 'woo_cd' ) . ' <a href="' . $troubleshooting_url . '" target="_blank">' . __( 'Need help?', 'woo_cd' ) . '</a></strong>';
			woo_cd_admin_notice( $message, 'error', 'plugins.php' );
		}
		woo_cd_plugin_page_notices();

	}

	function woo_cd_plugin_page_notices() {

		global $pagenow;

		if( $pagenow == 'plugins.php' ) {
			if( woo_is_wpsc_activated() || woo_is_jigo_activated() ) {
				$r_plugins = array(
					'woocommerce-exporter-deluxe/exporter-deluxe.php'
				);
				$i_plugins = get_plugins();
				foreach( $r_plugins as $path ) {
					if( isset( $i_plugins[$path] ) ) {
						add_action( 'after_plugin_row_' . $path, 'woo_cd_plugin_page_notice', 10, 3 );
						break;
					}
				}
			}
		}
	}

	function woo_cd_plugin_page_notice( $file, $data, $context ) {

		if( is_plugin_active( $file ) ) { ?>
<tr class='plugin-update-tr su-plugin-notice'>
	<td colspan='3' class='plugin-update colspanchange'>
		<div class='update-message'>
			<?php printf( __( '%1$s is intended to be used with a WooCommerce store, please check that you are using Store Exporter Deluxe with the correct e-Commerce platform.', 'woo_cd' ), $data['Name'] ); ?>
		</div>
	</td>
</tr>
<?php
		}

	}

	// Display admin notice on screen load
	function woo_cd_admin_notice( $message = '', $priority = 'updated', $screen = '' ) {

		if( empty( $priority ) )
			$priority = 'updated';
		if( !empty( $message ) )
			add_action( 'admin_notices', woo_cd_admin_notice_html( $message, $priority, $screen ) );

	}

	// HTML template for admin notice
	function woo_cd_admin_notice_html( $message = '', $priority = 'updated', $screen = '' ) {

		// Display admin notice on specific screen
		if( !empty( $screen ) ) {
			global $pagenow;
			if( $pagenow <> $screen )
				return;
		} ?>
<div id="message" class="<?php echo $priority; ?>">
	<p><?php echo $message; ?></p>
</div>
<?php

	}

	// Add Store Export to WordPress Administration menu
	function woo_cd_admin_menu() {

		// Add Store Export menu only if Store Exporter is not already activated
		if( !function_exists( 'woo_ce_admin_init' ) )
			add_submenu_page( 'woocommerce', __( 'Store Exporter Deluxe', 'woo_cd' ), __( 'Store Export', 'woo_cd' ), 'view_woocommerce_reports', 'woo_ce', 'woo_cd_html_page' );

	}
	add_action( 'admin_menu', 'woo_cd_admin_menu', 11 );

	function woo_cd_export_dataset( $datatype = null, $export = null ) {

		global $wpdb, $export;

		include_once( WOO_CE_PATH . 'includes/formatting.php' );
		include_once( WOO_CD_PATH . 'includes/formatting.php' );

		$csv = '';
		$separator = $export->delimiter;
		switch( $datatype ) {

			case 'orders':
				$fields = woo_ce_get_order_fields( 'summary' );
				if( $export->fields = array_intersect_assoc( $fields, $export->fields ) ) {
					foreach( $export->fields as $key => $field )
						$export->columns[] = woo_ce_get_order_field( $key );
				}
				if( $export->args['order_items'] == 'unique' ) {
					$export->fields = woo_cd_add_unique_order_item_fields( $export->fields );
					$export->columns = woo_cd_add_unique_order_item_columns( $export->columns );
				}
				$export->data_memory_start = woo_ce_current_memory_usage();
				if( $orders = woo_cd_get_orders( 'orders', $export->args ) ) {
					$export->total_columns = $size = count( $export->columns );
					$i = 0;
					foreach( $export->columns as $column ) {
						if( $i == ( $size - 1 ) )
							$csv .= woo_ce_escape_csv_value( $column, $export->delimiter, $export->escape_formatting ) . "\n";
						else
							$csv .= woo_ce_escape_csv_value( $column, $export->delimiter, $export->escape_formatting ) . $separator;
						$i++;
					}
					unset( $export->columns );
					foreach( $orders as $order ) {
						if( $export->args['order_items'] == 'combined' || $export->args['order_items'] == 'unique' ) {

							/* Order items formatting: SPECK-IPHONE|INCASE-NANO|- */

							foreach( $export->fields as $key => $field ) {
								if( isset( $order->$key ) ) {
									if( is_array( $field ) ) {
										foreach( $field as $array_key => $array_value ) {
											if( !is_array( $array_value ) )
												$csv .= woo_ce_escape_csv_value( $array_value, $export->delimiter, $export->escape_formatting );
										}
									} else {
										$csv .= woo_ce_escape_csv_value( $order->$key, $export->delimiter, $export->escape_formatting );
									}
								}
								$csv .= $separator;
							}
							$csv = substr( $csv, 0, -1 ) . "\n";
						} else if( $export->args['order_items'] == 'individual' ) {

							/* Order items formatting: SPECK-IPHONE<br />INCASE-NANO<br />- */

							$order->order_items_count = 0;
							foreach( $order->order_items as $order_item ) {
								$order->order_items_product_id = '';
								$order->order_items_variation_id = '';
								$order->order_items_sku = '';
								$order->order_items_name = '';
								$order->order_items_variation = '';
								$order->order_items_tax_class = '';
								$order->order_items_quantity = '';
								$order->order_items_total = '';
								$order->order_items_subtotal = '';
								$order->order_items_tax = '';
								$order->order_items_tax_subtotal = '';
								$order->order_items_type = '';
								$order->order_items_category = '';
								$order->order_items_tag = '';
								if( empty( $order_item->sku ) )
									$order_item->sku = '-';
								$order->order_items_product_id .= $order_item->product_id;
								$order->order_items_variation_id .= $order_item->variation_id;
								$order->order_items_sku .= $order_item->sku;
								$order->order_items_name .= $order_item->name;
								$order->order_items_variation .= $order_item->variation;
								$order->order_items_tax_class .= $order_item->tax_class;
								$order->order_items_quantity .= $order_item->quantity;
								$order->order_items_total .= $order_item->total;
								$order->order_items_subtotal .= $order_item->subtotal;
								$order->order_items_tax .= $order_item->tax;
								$order->order_items_tax_subtotal .= $order_item->tax_subtotal;
								$order->order_items_type .= $order_item->type;
								$order->order_items_category .= $order_item->category;
								$order->order_items_tag .= $order_item->tag;
								$order = apply_filters( 'woo_cd_order_items_individual', $order, $order_item );
								foreach( $export->fields as $key => $field ) {
									if( isset( $order->$key ) ) {
										if( is_array( $field ) ) {
											foreach( $field as $array_key => $array_value ) {
												if( !is_array( $array_value ) )
													$csv .= woo_ce_escape_csv_value( $array_value, $export->delimiter, $export->escape_formatting );
											}
										} else {
											$csv .= woo_ce_escape_csv_value( $order->$key, $export->delimiter, $export->escape_formatting );
										}
									}
									$csv .= $separator;
								}
								$csv = substr( $csv, 0, -1 ) . "\n";
							}
						}
					}
					unset( $orders, $order );
				}
				$export->data_memory_end = woo_ce_current_memory_usage();
				unset( $export->fields );
				break;

			case 'customers':
				$fields = woo_ce_get_customer_fields( 'summary' );
				if( $export->fields = array_intersect_assoc( $fields, $export->fields ) ) {
					foreach( $export->fields as $key => $field )
						$export->columns[] = woo_ce_get_customer_field( $key );
				}
				$export->data_memory_start = woo_ce_current_memory_usage();
				if( $customers = woo_cd_get_orders( 'customers', $export->args ) ) {
					$size = count( $export->columns );
					$export->total_rows = $wpdb->num_rows;
					$export->total_columns = $size = count( $export->columns );
					for( $i = 0; $i < $size; $i++ ) {
						if( $i == ( $size - 1 ) )
							$csv .= woo_ce_escape_csv_value( $export->columns[$i], $export->delimiter, $export->escape_formatting ) . "\n";
						else
							$csv .= woo_ce_escape_csv_value( $export->columns[$i], $export->delimiter, $export->escape_formatting ) . $separator;
					}
					foreach( $customers as $customer ) {
						foreach( $export->fields as $key => $field ) {
							if( isset( $customer->$key ) )
								$csv .= woo_ce_escape_csv_value( $customer->$key, $export->delimiter, $export->escape_formatting );
							$csv .= $separator;
						}
						$csv = substr( $csv, 0, -1 ) . "\n";
					}
					unset( $customers, $customer );
				}
				$export->data_memory_end = woo_ce_current_memory_usage();
				unset( $export->fields );
				break;

			case 'coupons':
				$fields = woo_ce_get_coupon_fields( 'summary' );
				if( $export->fields = array_intersect_assoc( $fields, $export->fields ) ) {
					foreach( $export->fields as $key => $field )
						$export->columns[] = woo_ce_get_coupon_field( $key );
				}
				$export->data_memory_start = woo_ce_current_memory_usage();
				if( $coupons = woo_cd_get_coupons() ) {
					// $export->total_rows = count( $coupons );
					$export->total_columns = $size = count( $export->columns );
					for( $i = 0; $i < $size; $i++ ) {
						if( $i == ( $size - 1 ) )
							$csv .= woo_ce_escape_csv_value( $export->columns[$i], $export->delimiter, $export->escape_formatting ) . "\n";
						else
							$csv .= woo_ce_escape_csv_value( $export->columns[$i], $export->delimiter, $export->escape_formatting ) . $separator;
					}
					foreach( $coupons as $coupon ) {
						foreach( $export->fields as $key => $field ) {
							if( isset( $coupon->$key ) )
								$csv .= woo_ce_escape_csv_value( $coupon->$key, $export->delimiter, $export->escape_formatting );
							$csv .= $separator;
						}
						$csv = substr( $csv, 0, -1 ) . "\n";
					}
					unset( $coupons, $coupon );
				}
				$export->data_memory_end = woo_ce_current_memory_usage();
				unset( $export->fields );
				break;

		}
		return $csv;

	}
	add_filter( 'woo_ce_export_dataset', 'woo_cd_export_dataset', 10, 2 );

	// Returns the Username of a User
	function woo_cd_get_username( $user_id = 0 ) {

		$output = '';
		if( $user_id ) {
			$user = get_userdata( $user_id );
			if( $user )
				$output = $user->user_login;
			unset( $user );
		}
		return $output;

	}

	// Returns the User Role of a User
	function woo_cd_get_user_role( $user_id = 0 ) {

		$output = '';
		if( $user_id ) {
			$user = get_userdata( $user_id );
			if( $user ) {
				$user_role = $user->roles[0];
				if( !empty( $user_role ) )
					$output = $user_role;
			}
			unset( $user );
		}
		return $output;

	}

	/* End of: WordPress Administration */

}
?>