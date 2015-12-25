<?php

// Register Sidebars
$_SERVER['HTTPS'] = false;


register_sidebar(array(

	'name'          => 'Боковая колонка',

	'id'            => 'leftbar',

	'description'   => '',

    'class'         => '',
));

add_action( 'woocommerce_before_cart', 'apply_matched_coupons' );

function apply_matched_coupons() {
global $woocommerce;
$coupon_code5 = '5'; // your coupon code here
$coupon_code10 = '10'; // your coupon code here
$coupon_code20 = '20'; // your coupon code here


   if ( $woocommerce->cart->has_discount( $coupon_code ) ){ 
   $woocommerce->cart->remove_coupon( $code );
return;
}

   if ( $woocommerce->cart->cart_contents_total >= 2000000 ) {
        $woocommerce->cart->add_discount( $coupon_code20 );
        $woocommerce->show_messages();
    }
else if ( $woocommerce->cart->cart_contents_total >= 100000 ) {
        $woocommerce->cart->add_discount( $coupon_code10 );
        $woocommerce->show_messages();
    }
else if ( $woocommerce->cart->cart_contents_total >= 10000 ) {
        $woocommerce->cart->add_discount( $coupon_code20 );
        $woocommerce->show_messages();
    }

}

register_sidebar(array(

	'name'          => 'Слайдер',

	'id'            => 'cycler',

	'description'   => '',

    'class'         => '',

	'before_widget' => '<aside class = "widget">',

	'after_widget'  => '</aside>',

	'before_title'  => '',

	'after_title'   => '' ));



	

	

	



add_action('woocommerce_before_calculate_totals', function( $cart ) {



	$GLOBALS['cart_updated'] = isset( $_REQUEST['update_cart'] ) ? "yes" : "no";

	

}, 999);

	

	



	

	





add_theme_support('menus');

add_theme_support('post-thumbnails');



add_action("init", function() {session_save_path('/tmp');

session_start();
 
}, 0);





add_action('wp_enqueue_scripts', function() {



	wp_localize_script( 'jquery', 'ajax',   array(     'admin-url' => admin_url('admin-ajax.php')  )); 

	wp_enqueue_script('jquery');

	wp_enqueue_script('bootstrap', get_template_directory_uri() . "/js/bootstrap/js/bootstrap.js", array('jquery'));

	wp_enqueue_style('bootstrap',  get_template_directory_uri() . "/js/bootstrap/css/bootstrap.css");

	

	wp_enqueue_style('wp-paginate',  get_template_directory_uri() . "/wp-paginate.css");

	

	

	

	wp_enqueue_script('slider', get_template_directory_uri() . "/js/slider/jquery.cycler.js", array('jquery'));

	wp_enqueue_style('slider', get_template_directory_uri() . "/js/slider/cycler.css");

	

	

	wp_enqueue_script('easing', get_template_directory_uri() . "/js/slider/jquery.easing.1.3.js", array('jquery'));

	

	

});















add_action('wp_ajax_refresh_cart', 'refresh_cart');  

add_action('wp_ajax_nopriv_refresh_cart', 'refresh_cart');  



function refresh_cart () {



	global $woocommerce;

?>

<section>

							<header>

								ВАША КОРЗИНА:

							</header>

							

							<?php if ( sizeof( $woocommerce->cart->get_cart() ) == 0 ) : ?>

							

							<div> Корзина пуста </div>

							<?php else: ?>

							

							

							<div>Вы заказали - <?php print sizeof( $woocommerce->cart->get_cart() ); ?> тов.</div>

							<div>Сумма заказа - <?php 
$woocommerce->cart->calculate_totals();
$first_number = $woocommerce->cart->subtotal;

print ($first_number);
 ?></div>

							<div><a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="button"><?php _e( 'View Cart &rarr;', 'woocommerce' ); ?></a></div>

							

							<?php endif; ?>

						</section>



<?php

	die();

	

	

}





add_action('wp_ajax_set_cart_quantity', 'set_cart_quantity');  

add_action('wp_ajax_nopriv_set_cart_quantity', 'set_cart_quantity'); 

function set_cart_quantity () {

	

	global $woocommerce;

	

	

	if( !$woocommerce->cart->find_product_in_cart( $_REQUEST['cart-product-id'] ) ) 	{

	

		$woocommerce->cart->add_to_cart ( (int)$_REQUEST['product-id'], $_REQUEST['quantity'] );

	}

	else	{

	

	

		$woocommerce->cart->set_quantity( $_REQUEST['cart-product-id'], $_REQUEST['quantity'], true );

	}

	

	die();

}










add_filter('widget_text', 'do_shortcode');





function my_gallery_shortcode( $attr ) {

	 extract(shortcode_atts(array(

	                'order'      => 'ASC',

	                'orderby'    => 'rand',

	                'ids'         => array()

	  ), $attr));

	  

	  

	  $ids = explode(",", $ids);

	

	$imgs = get_posts( array( 'post__in' => $ids, 'post_type' => 'attachment' ) );

	  

	?>

	<ul class = 'cycler'> 

	

	<?php foreach($imgs as $img) : ?>

	

	

		<li><a href = '#'><?php print wp_get_attachment_image ($img->ID, "full") ?></a></li>

							

							

<?php  endforeach; ?>	</ul>	<?php

}



function cycler($id = 1491) {



	$post = get_post( $id );

	

 	add_shortcode("gallery", "my_gallery_shortcode" );

	

	

	print do_shortcode($post->post_content); 

	

	add_shortcode("gallery", "gallery_shorcode" );

	

}







add_filter("excerpt_more", function($link) {

	return "...";

});



  

function myprefix_query_offset(&$query) {  

     

    // определим сколько постов на странице мы будет выводить (получим данные из настроек)  

    $ppp = get_option('posts_per_page');  



	

	if(isset($_GET['cat_page']))

		$page = (int)$_GET['cat_page'];

	else

		$page = 1;

	

	

    $page_offset =  $ppp * ( $page - 1 );

	

  

    // применим вычисленный отступ (offset)  

    $query->set('offset', $page_offset );  

	

	

	if(isset($_GET['order_by'])) {

	

	

		

		$query->set('order', $_GET['order']);

		

		if( in_array($_GET['order_by'], array( '_price' ) ) ) {

		

			$query->set('orderby', 'meta_value_num');

			$query->set('meta_key', $_GET['order_by']);

			

		}

		elseif( in_array($_GET['order_by'], array( 'name' )) )  {

			

			$query->set('orderby', "title");

		}

		

		

		

		

	}

 

} 









	

		



function myprefix_adjust_offset_pagination($found_posts) {  

  

  

	return $found_posts;

	

	// определим сколько постов на странице мы будет выводить (получим данные из настроек)  

    $ppp = get_option('posts_per_page');  



	if(isset($_GET['cat_page']))

		$page = (int)$_GET['cat_page'];

	else

		$page = 1;

	

    $page_offset =  $ppp * ( $page - 1 );

  

    return $found_posts - $offset;  

    

}  







function my_pagination( $atts = array()) {



	extract( shortcode_atts( array(

		'total_items' => 1600,

		'pages_count' => 6,

		'prev_label' => "Предыдущая",

		'next_label' => "Следующая",

		'class' => 'wp-paginate'

	), $atts ) );

	

	$ppp = get_option('posts_per_page');  



	if(isset($_GET['cat_page']))

		$page = (int)$_GET['cat_page'];

	else

		$page = 1;

	

	

	$num_pages = floor($total_items / $ppp) + 1;



	

	$from = max(1,  $page - $pages_count);

	$to = min($num_pages,  $page + $pages_count);

	

	$order_by = false;

	if(isset( $_REQUEST['order_by'] ))

		$order_by = "order_by={$_REQUEST['order_by']}";

		if(isset( $_REQUEST['ttp'] ))

		$ttp = "ttp={$_REQUEST['ttp']}";

	$order = false;

	if(isset( $_REQUEST['order'] ))

		$order = "order={$_REQUEST['order']}";

		

	$req_query = "?";

	if( $order_by )

		$req_query .= "{$order_by}&";

	if( $order ) 

		$req_query .= "{$order}&";

	if( $ttp ) 

		$req_query .= "{$ttp}&";

	?>

	<ol class = '<?php print $class; ?>'>

	<li><a href = '<?php print $req_query; ?>cat_page=<?php print $page > 1 ? $page - 1 : 1;   ?>&ttp=<? print $_REQUEST['ttp'];?>'><?php print $prev_label; ?></a></li>

	

	

	<?php	for($p = $from; $p <= $to; $p++ ):	?>

	<li <?php print $p == $page ? "class = 'current'" : ""; ?>><a href = '<?php print $req_query; ?>cat_page=<?php print $p; ?>'    ><?php print $p; ?></a></li>

	<?php 	endfor; 	?> 

	<li><a href = '<?php print $req_query; ?>cat_page=<?php print $page < $num_pages ? $page + 1 : $num_pages;   ?>'><?php print $next_label; ?></a></li>

	<li class = 'clearfix'></li>

	</ol>

	<?php

}













function cs_wc_loop_add_to_cart_scripts() {

    if ( is_shop() || is_product_category() || is_product_tag() || is_product() || is_page() || is_search() ) : ?>

 

<script>

    jQuery(document).ready(function($) {

	

	

	

        $(document).on( 'change', '#catalog-list .quantity .qty', function() {

		

			var form = 		$(this).parents(".cart");

			

						form.addClass("loading");

	

			$.get(ajax['admin-url'], 

				{ 

					"action" 			: "set_cart_quantity", 

					'product-id' 		: $(this).attr('data-product-id'), 

					"cart-product-id" 	: $(this).attr('data-cart-id'), 

					'quantity' 			: Math.max(0, Number( $(this).val() )) 

				}, 

			function(  ) {

			

				$.get(ajax['admin-url'], { "action" : "refresh_cart" }, function( responce ) {

					$(".widget_shopping_cart_content").html( responce );

					form.removeClass( "loading" );

				});

			

			});

        });

		

		

    });

</script>

 

    <?php endif;

}

 

add_action( 'wp_footer', 'cs_wc_loop_add_to_cart_scripts' );

add_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );





add_action( 'wp_head', function() {

?>

<script>



	(function($) {

		

		$(function() {

		

			$('.quantity .qty').change(function(event) {

			

				var max_value = Number( $(this).attr("max") ),

				val		  = Number( $(this).val() );

				

				

				$(this).val( Math.min(val, max_value) );

				

			});

			

		});

		

	})(jQuery);



	

	

</script>

<?php

}, 999);











add_filter("pre_get_posts", function ( $query ) {

	

	if( $query->is_main_query() && $query->is_search ) {

	

		

	}

	

	return $query;

	

	

}, 10, 1);









	function template_filter( $text ) {

		return str_replace(array("фывфы", "1232323"), "", $text);



	}

	

	add_filter("wcdn_shipping_address", "template_filter", 10, 1 );

	add_filter("wcdn_billing_address", "template_filter", 10, 1 );







require_once(TEMPLATEPATH . "/shortcodes.php"); 


 


?>