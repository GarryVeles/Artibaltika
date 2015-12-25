<?php
/*
Plugin Name: Jquery Zooming
Plugin URI: 
Description: Jquery Zooming
Version: 1.0
Author: isite39.ru
Author URI: http://isite39.ru
*/
	add_action("wp_enqueue_scripts", "jq_zooming_enqueue_scripts");		function jq_zooming_enqueue_scripts() {			wp_enqueue_script('zooming', plugins_url() . '/' . ('jquery-zooming/js/jquery.zooming.js') , array("jquery"));		wp_enqueue_style('zooming', plugins_url() . '/' . ("jquery-zooming/js/zooming.css"));	}

	add_action("wp_head", "jq_zooming_wp_head", 999);	function jq_zooming_wp_head() {	?>	<script>	jQuery(function() {		jQuery(".tabbable a.photo img").zooming({'min-width': 380, 'max-width': 390});	});	</script>	<?php	}
?>
