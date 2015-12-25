<?php
	// HTML template for Custom Products widget on Store Exporter screen
	function woo_cd_products_custom_fields() {

		if( $custom_products = woo_ce_get_option( 'custom_products', '' ) )
			$custom_products = implode( "\n", $custom_products );
		ob_start(); ?>
<div id="export-products-custom-fields-link" class="separator">
	<p><a href="#export-products-custom-fields"><?php _e( 'Manage Custom Product Fields', 'woo_ce' ); ?></a></p>
<form method="post" id="export-products-custom-fields">
	<div id="poststuff">

		<div class="postbox" id="export-options">
			<h3 class="hndle"><?php _e( 'Custom Product Fields', 'woo_ce' ); ?></h3>
			<div class="inside">
				<p class="description"><?php _e( 'To include additional custom Product meta in the Export Products table above fill the Products text box then click Save Custom Fields.', 'woo_ce' ); ?></p>
				<table class="form-table">

					<tr>
						<th>
							<label><?php _e( 'Product Meta', 'woo_ce' ); ?></label>
						</th>
						<td>
							<textarea name="custom_products" rows="5" cols="70"><?php echo $custom_products; ?></textarea>
							<p class="description"><?php _e( 'Include additional custom Product meta in your exported CSV by adding each custom Product meta name to a new line above.<br />For example: <code>Customer UA, Customer IP Address</code>', 'woo_ce' ); ?></p>
						</td>
					</tr>

				</table>
				<p class="submit">
					<input type="submit" value="<?php _e( 'Save Custom Fields', 'woo_ce' ); ?>" class="button-primary" />
				</p>
				<p class="description"><?php _e( 'For more information on custom Product meta consult our online documentation.', 'woo_ce' ); ?></p>
			</div>
			<!-- .inside -->
		</div>
		<!-- .postbox -->

	</div>
	<input type="hidden" name="action" value="update" />
</form>
<!-- #export-products-custom-fields-link -->
<?php
		ob_end_flush();

	}

	function woo_cd_extend_product_fields( $fields ) {

		// Cost of Goods - http://www.skyverge.com/product/woocommerce-cost-of-goods-tracking/
		if( class_exists( 'WC_COG' ) ) {
			$fields[] = array(
				'name' => 'cost_of_goods',
				'label' => __( 'Cost of Goods', 'woo_ce' ),
				'default' => 1
			);
		}

		// Per-Product Shipping - http://www.woothemes.com/products/per-product-shipping/
		if( function_exists( 'woocommerce_per_product_shipping_init' ) ) {
			$fields[] = array(
				'name' => 'per_product_shipping',
				'label' => __( 'Per-Product Shipping', 'woo_ce' ),
				'default' => 1
			);
		}

		// Advanced Custom Fields - http://www.advancedcustomfields.com
		if( class_exists( 'acf' ) ) {
			if( $custom_fields = woo_cd_get_acf_product_fields() ) {
				foreach( $custom_fields as $custom_field ) {
					$fields[] = array(
						'name' => $custom_field['name'],
						'label' => $custom_field['label'],
						'default' => 1
					);
				}
				unset( $custom_fields, $custom_field );
			}
		}

		$custom_products = woo_ce_get_option( 'custom_products', '' );
		if( !empty( $custom_products ) ) {
			foreach( $custom_products as $custom_product ) {
				if( !empty( $custom_product ) ) {
					$fields[] = array(
						'name' => $custom_product,
						'label' => $custom_product,
						'default' => 1
					);
				}
			}
			unset( $custom_products, $custom_product );
		}

		return $fields;

	}
	add_filter( 'woo_ce_product_fields', 'woo_cd_extend_product_fields' );

	function woo_cd_get_acf_product_fields() {

		global $wpdb;

		$post_type = 'acf';
		$args = array(
			'post_type' => $post_type,
			'numberposts' => -1,
			'cache_results' => false,
			'no_found_rows' => false
		);
		if( $field_groups = get_posts( $args ) ) {
			$fields = array();
			$post_types = array( 'product', 'product_variation' );
			foreach( $field_groups as $field_group ) {
				$has_fields = false;
				if( $rules = get_post_meta( $field_group->ID, 'rule' ) ) {
					$size = count( $rules );
					for( $i = 0; $i < $size; $i++ ) {
						if( ( $rules[$i]['param'] == 'post_type' ) && ( $rules[$i]['operator'] == '==' ) && ( in_array( $rules[$i]['value'], $post_types ) ) ) {
							$has_fields = true;
							$i = $size;
						}
					}
				}
				unset( $rules );
				if( $has_fields ) {
					$custom_fields_sql = "SELECT `meta_value` FROM `" . $wpdb->postmeta . "` WHERE `post_id` = " . (int)$field_group->ID . " AND `meta_key` LIKE 'field_%'";
					if( $custom_fields = $wpdb->get_col( $custom_fields_sql ) ) {
						foreach( $custom_fields as $custom_field ) {
							$custom_field = maybe_unserialize( $custom_field );
							$fields[] = array(
								'name' => $custom_field['name'],
								'label' => $custom_field['label']
							);
						}
					}
					unset( $custom_fields, $custom_field );
				}
			}
			return $fields;
		}

	}

	function woo_cd_extend_product_item_cog( $product, $product_id ) {

		// Cost of Goods - http://www.skyverge.com/product/woocommerce-cost-of-goods-tracking/
		if( class_exists( 'WC_COG' ) ) {
			$product->cost_of_goods = get_post_meta( $product_id, '_wc_cog_cost', true );
		}
		return $product;

	}
	add_filter( 'woo_ce_product_item', 'woo_cd_extend_product_item_cog', 10, 2 );

	function woo_cd_extend_product_item_pps( $product, $product_id ) {

		// Per-Product Shipping - http://www.woothemes.com/products/per-product-shipping/
		if( function_exists( 'woocommerce_per_product_shipping_init' ) ) {
			$product->per_product_shipping = get_post_meta( $product_id, 'per_product_shipping', true );
		}
		return $product;

	}
	add_filter( 'woo_ce_product_item', 'woo_cd_extend_product_item_pps', 10, 2 );

	function woo_cd_extend_product_item_custom_products( $product, $product_id ) {

		$custom_products = woo_ce_get_option( 'custom_products', '' );
		if( !empty( $custom_products ) ) {
			foreach( $custom_products as $custom_product ) {
				if( !empty( $custom_product ) )
					$product->{$custom_product} = get_post_meta( $product->ID, $custom_product, true );
			}
		}
		return $product;

	}
	add_filter( 'woo_ce_product_item', 'woo_cd_extend_product_item_custom_products', 10, 2 );

?>