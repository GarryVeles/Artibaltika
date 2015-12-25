<?php
/**
*
* Filename: common.php
* Description: common.php loads commonly accessed functions across the Visser Labs suite.
* 
* - vl_updater_install
* - vl_updater_notice
* - woo_get_action
*
*/

if( is_admin() ) {

	/* Start of: WordPress Administration */

	/**
	 * Load installer for the Visser Labs Updater.
	 */
	if ( ! class_exists( 'VL_Updater' ) && ! function_exists( 'vl_updater_install' ) ) {
		function vl_updater_install( $api, $action, $args ) {

			if ( 'plugin_information' != $action ||
				false !== $api ||
				! isset( $args->slug ) ||
				'visser-labs-updater' != $args->slug
			) return $api;
			$download_url = 'http://updates.visser.com.au/downloads/visser-labs-updater.zip';
			$api = new stdClass();
			$api->name = 'Visser Labs Updater';
			$api->version = '1.0';
			$api->download_link = esc_url( $download_url );
			return $api;

		}
		add_filter( 'plugins_api', 'vl_updater_install', 10, 3 );
	}

	/**
	 * Visser Labs Updater Installation Prompts
	 */
	if ( ! class_exists( 'VL_Updater' ) && ! function_exists( 'vl_updater_notice' ) ) {
		function vl_updater_notice() {

			if ( isset( $_GET['action'] ) && $_GET['action'] == 'install-plugin' ) return;
			if ( isset( $_GET['action'] ) && $_GET['action'] == 'dimiss-update-notice' ) {
				update_option( 'vl_dismiss_update_notice', 1 );
				return;
			}

			$active_plugins = apply_filters( 'active_plugins', get_option( 'active_plugins', array() ) );
			if ( in_array( 'visser-labs-updater/visser-labs-updater.php', $active_plugins ) ) return;
			if( get_option( 'vl_dismiss_update_notice', false ) == false ) {
				$slug = 'visser-labs-updater';
				$install_url = wp_nonce_url( self_admin_url( add_query_arg( array( 'action' => 'install-plugin', 'plugin' => $slug ), 'update.php' ) ), sprintf( 'install-plugin_%s', $slug ) );
				$activate_url = add_query_arg( array( 'action' => 'activate', 'plugin' => urlencode( 'visser-labs-updater/visser-labs-updater.php' ), 'plugin_status' => 'all', 'paged' => 1, '_wpnonce' => urlencode( wp_create_nonce( 'activate-plugin_visser-labs-updater/visser-labs-updater.php' ) ) ), 'plugins.php' );
				$dismiss_url = self_admin_url( add_query_arg( 'action', 'dismiss-update-notice' ) );
				$is_downloaded = false;
				$message = sprintf( __( '<a href="%s">Install the Visser Labs Updater plugin</a> to get updates for your Visser Labs plugins.', 'vl_updater' ), esc_url( $install_url ) );
				if( $plugins = array_keys( get_plugins() ) ) {
					foreach ( $plugins as $plugin ) {
						if ( strpos( $plugin, 'visser-labs-updater.php' ) !== false ) {
							$is_downloaded = true;
							$message = sprintf( __( '<a href="%s">Activate the Visser Labs Updater plugin</a> to get updates for your Visser Labs plugins.', 'vl_updater' ), esc_url( admin_url( $activate_url ) ) );
						}
					}
				}
				echo '<div class="updated fade"><p>' . $message . '<span style="float:right;"><a href="' . $dismiss_url . '">' . __( 'Dismiss', 'vl_updater' ) . '</a></span></p></div>' . "\n";
			}

		}
		add_action( 'admin_notices', 'vl_updater_notice' );
	}

	/* End of: WordPress Administration */

}

if( ! function_exists( 'woo_get_action' ) ) {
	function woo_get_action( $prefer_get = false ) {

		if ( isset( $_GET['action'] ) && $prefer_get )
			return $_GET['action'];

		if ( isset( $_POST['action'] ) )
			return $_POST['action'];

		if ( isset( $_GET['action'] ) )
			return $_GET['action'];

		return false;

	}
}
?>