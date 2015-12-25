<?php
if( is_admin() ) {

	/* Start of: WordPress Administration */

	// HTML template header on Store Exporter screen
	function woo_cd_template_header( $title = '', $icon = 'woocommerce' ) { ?>
<div class="wrap">
	<div id="icon-<?php echo $icon; ?>" class="icon32 icon32-woocommerce-importer"><br /></div>
	<h2><?php echo $title; ?></h2>
<?php
	}

	// HTML template footer on Store Exporter screen
	function woo_cd_template_footer() { ?>
</div>
<!-- .wrap -->
<?php
	}

	function woo_cd_template_header_title() {

		$output = __( 'Store Exporter Deluxe', 'woo_cd' );
		return $output;

	}
	add_filter( 'woo_ce_template_header', 'woo_cd_template_header_title' );

	/* End of: WordPress Administration */

}
?>