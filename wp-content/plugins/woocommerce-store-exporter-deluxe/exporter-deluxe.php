<?php
/*
Plugin Name: WooCommerce - Store Exporter Deluxe
Plugin URI: http://www.visser.com.au/woocommerce/plugins/exporter-deluxe/
Description: Unlocks business focused e-commerce features within Store Exporter for WooCommerce. Requires Store Exporter Plugin to be installed and activated.
Version: 1.4.6
Author: Visser Labs
Author URI: http://www.visser.com.au/about/
License: GPL2
*/

define( 'WOO_CD_DIRNAME', basename( dirname( __FILE__ ) ) );
define( 'WOO_CD_PATH', plugin_dir_path( __FILE__ ) );

include_once( WOO_CD_PATH . 'common/common.php' );
include_once( WOO_CD_PATH . 'includes/common.php' );
include_once( WOO_CD_PATH . 'includes/functions.php' );
include_once( WOO_CD_PATH . 'includes/template.php' );

function woo_cd_i18n() {

	load_plugin_textdomain( 'woo_cd', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

}
add_action( 'init', 'woo_cd_i18n' );

if( is_admin() ) {

	/* Start of: WordPress Administration */

	// Add Export, Docs and Premium Support links to the Plugins screen
	function woo_cd_add_settings_link( $links, $file ) {

		static $this_plugin;
		if( !$this_plugin ) $this_plugin = plugin_basename( __FILE__ );
		if( $file == $this_plugin ) {
			$support_url = 'http://www.visser.com.au/premium-support/';
			$support_link = sprintf( '<a href="%s" target="_blank">' . __( 'Premium Support', 'woo_ce' ) . '</a>', $support_url );
			$docs_url = 'http://www.visser.com.au/docs/';
			$docs_link = sprintf( '<a href="%s" target="_blank">' . __( 'Docs', 'woo_ce' ) . '</a>', $docs_url );
			$export_link = sprintf( '<a href="%s">' . __( 'Export', 'woo_ce' ) . '</a>', add_query_arg( 'page', 'woo_ce', 'admin.php' ) );
			array_unshift( $links, $support_link );
			array_unshift( $links, $docs_link );
			if( function_exists( 'woo_ce_admin_init' ) )
				array_unshift( $links, $export_link );
		}
		return $links;

	}
	add_filter( 'plugin_action_links', 'woo_cd_add_settings_link', 10, 2 );

	// Load CSS and jQuery scripts for Store Exporter Deluxe screen
	function woo_cd_enqueue_styles( $hook ) {

		$page = 'woocommerce_page_woo_cd';
		if( $page == $hook ) {
			// WooCommerce
			global $woocommerce;
			wp_enqueue_style( 'woocommerce_admin_styles', $woocommerce->plugin_url() . '/assets/css/admin.css' );
		}
		wp_enqueue_style( 'woo_vm_styles', plugins_url( '/templates/admin/woocommerce-admin_dashboard_vm-plugins.css', __FILE__ ) );

	}
	add_action( 'admin_enqueue_scripts', 'woo_cd_enqueue_styles' );

	// Initial scripts and export process
	function woo_cd_admin_init() {

		// Detect Store Exporter and other platform versions
		woo_cd_detect_ce();

		// Remove disabled widgets from Export screen
		remove_action( 'woo_ce_export_order_options_before_table', 'woo_ce_orders_filter_by_date', 10 );
		remove_action( 'woo_ce_export_order_options_before_table', 'woo_ce_orders_filter_by_status', 10 );
		remove_action( 'woo_ce_export_order_options_before_table', 'woo_ce_orders_filter_by_customer', 10 );
		remove_action( 'woo_ce_export_order_options_before_table', 'woo_ce_orders_filter_by_user_role', 10 );
		remove_action( 'woo_ce_export_order_options_after_table', 'woo_ce_orders_order_sorting', 10 );
		remove_action( 'woo_ce_export_after_form', 'woo_ce_products_custom_fields' );

		// Add Store Exporter Deluxe widgets to Export screen
		add_action( 'woo_ce_export_quicklinks', 'woo_cd_quicklink_custom_fields' );
		add_action( 'woo_ce_export_order_options_before_table', 'woo_cd_orders_filter_by_date' );
		add_action( 'woo_ce_export_order_options_before_table', 'woo_cd_orders_filter_by_status' );
		add_action( 'woo_ce_export_order_options_before_table', 'woo_cd_orders_filter_by_customer' );
		add_action( 'woo_ce_export_order_options_before_table', 'woo_cd_orders_filter_by_user_role' );
		add_action( 'woo_ce_export_order_options_after_table', 'woo_cd_orders_order_sorting' );
		add_action( 'woo_ce_export_order_options_before_table', 'woo_cd_orders_items_formatting' );
		add_action( 'woo_ce_export_options_after', 'woo_cd_orders_max_order_items' );
		add_action( 'woo_ce_export_order_options_before_table', 'woo_cd_orders_custom_fields_link' );
		add_action( 'woo_ce_export_after_form', 'woo_cd_products_custom_fields' );
		add_action( 'woo_ce_export_after_form', 'woo_cd_orders_custom_fields' );

	}
	add_action( 'admin_init', 'woo_cd_admin_init', 11 );

	// HTML templates and form processor for Store Exporter Deluxe screen
	function woo_cd_html_page() {

		global $wpdb;

		$woo_ce_url = 'http://wordpress.org/extend/plugins/woocommerce-exporter/';
		$woo_ce_search = add_query_arg( array( 'tab' => 'search', 's' => 'WooCommerce+Store+Exporter' ), admin_url( 'plugin-install.php' ) );

		woo_cd_template_header( __( 'Store Exporter Deluxe', 'woo_cd' ) );
		include_once( 'templates/admin/woo-admin_cd-export.php' );
		woo_cd_template_footer();

	}

	/* End of: WordPress Administration */

}
?>