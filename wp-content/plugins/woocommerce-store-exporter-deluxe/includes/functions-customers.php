<?php
function woo_cd_get_customers_list() {

	$args = array(
		// Disabled Customer filters, will re-enable with UI options in future Plugin update
/*
		'fields' => 'all',
		'orderby' => 'display_name',
		'meta_key' => 'billing_email',
		'meta_value' => null,
		'search_columns'	=> array( 'ID', 'user_login', 'user_email', 'user_nicename' )
*/
	);
	$customers = get_users( $args );
	return $customers;

}

function woo_cd_is_duplicate_customer( $customers = array(), $order = array() ) {

	foreach( $customers as $key => $customer ) {
		if( $customer->user_id == $order->user_id || $customer->billing_email == $order->billing_email ) {
			return $key;
			break;
		}
	}
	return 0;

}
?>