<?php
/*

Filename: common.php
Description: common.php loads commonly accessed functions across the Visser Labs suite.

- woo_is_wpsc_activated
- woo_is_woo_activated
- woo_is_jigo_activated

*/

if( is_admin() ) {

	/* Start of: WordPress Administration */

	include_once( WOO_CD_PATH . 'includes/common-dashboard_widgets.php' );

	/* End of: WordPress Administration */

}

if( !function_exists( 'woo_is_wpsc_activated' ) ) {
	function woo_is_wpsc_activated() {

		if( class_exists( 'WP_eCommerce' ) )
			return true;

	}
}

if( !function_exists( 'woo_is_woo_activated' ) ) {
	function woo_is_woo_activated() {

		if( class_exists( 'Woocommerce' ) )
			return true;

	}
}

if( !function_exists( 'woo_is_jigo_activated' ) ) {
	function woo_is_jigo_activated() {

		if( function_exists( 'jigoshop_init' ) )
			return true;

	}
}
?>