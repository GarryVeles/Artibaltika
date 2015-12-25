<?php
function woo_cd_get_coupons() {

	global $export;

	$post_type = 'shop_coupon';
	$args = array(
		'post_type' => $post_type,
		'numberposts' => -1,
		'post_status' => woo_ce_post_statuses(),
		'cache_results' => false,
		'no_found_rows' => false
	);
	$export->total_rows = 0;
	if( $coupons = get_posts( $args ) ) {
		$export->total_rows = count( $coupons );
		foreach( $coupons as $key => $coupon ) {
			$coupons[$key]->coupon_code = $coupon->post_title;
			$coupons[$key]->discount_type = woo_cd_format_discount_type( get_post_meta( $coupon->ID, 'discount_type', true ) );
			$coupons[$key]->coupon_description = $coupon->post_excerpt;
			$coupons[$key]->coupon_amount = get_post_meta( $coupon->ID, 'coupon_amount', true );
			$coupons[$key]->individual_use = woo_ce_format_switch( get_post_meta( $coupon->ID, 'individual_use', true ) );
			$coupons[$key]->apply_before_tax = woo_ce_format_switch( get_post_meta( $coupon->ID, 'apply_before_tax', true ) );
			$coupons[$key]->exclude_sale_items = woo_ce_format_switch( get_post_meta( $coupon->ID, 'exclude_sale_items', true ) );
			$coupons[$key]->minimum_amount = get_post_meta( $coupon->ID, 'minimum_amount', true );
			$coupons[$key]->product_ids = woo_cd_convert_product_ids( get_post_meta( $coupon->ID, 'product_ids', true ) );
			$coupons[$key]->exclude_product_ids = woo_cd_convert_product_ids( get_post_meta( $coupon->ID, 'exclude_product_ids', true ) );
			$coupons[$key]->product_categories = woo_cd_convert_product_ids( get_post_meta( $coupon->ID, 'product_categories', true ) );
			$coupons[$key]->exclude_product_categories = woo_cd_convert_product_ids( get_post_meta( $coupon->ID, 'exclude_product_categories', true ) );
			$coupons[$key]->customer_email = woo_cd_convert_product_ids( get_post_meta( $coupon->ID, 'customer_email', true ) );
			$coupons[$key]->usage_limit = get_post_meta( $coupon->ID, 'usage_limit', true );
			$coupons[$key]->expiry_date = woo_ce_format_date( get_post_meta( $coupon->ID, 'expiry_date', true ) );
		}
		return $coupons;
	}

}
?>