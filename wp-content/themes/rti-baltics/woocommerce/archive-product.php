<?php

/**

 * The Template for displaying product archives, including the main shop page which is a post type archive.

 *

 * Override this template by copying it to yourtheme/woocommerce/archive-product.php

 *

 * @author 		WooThemes

 * @package 	WooCommerce/Templates

 * @version     2.0.0

 */



if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly



get_header('shop'); ?>


	<?php

		/**

		 * woocommerce_before_main_content hook

		 *

		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)

		 * @hooked woocommerce_breadcrumb - 20

		 */

		//do_action('woocommerce_before_main_content');

	?>

	<div id = 'middle'>

		<div class = 'page-wrapper'>

			<div id = 'secondary' class = 'left widgets-area'>

				<?php get_sidebar(); ?>

			</div>



			<div id = 'primary' class = 'right'>

		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>



			<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>



		<?php endif; ?>



		<?php do_action( 'woocommerce_archive_description' ); ?>

		

		

		

		

		

		

		

		




		<?php if ( have_posts() ) : ?>



			<?php

				/**

				 * woocommerce_before_shop_loop hook

				 *

				 * @hooked woocommerce_result_count - 20

				 * @hooked woocommerce_catalog_ordering - 30

				 */

				do_action( 'woocommerce_before_shop_loop' );

			?>



			<?php woocommerce_product_loop_start(); ?>



				<?php woocommerce_product_subcategories(); ?>

				

				

				<?php// global $wp_query; //$query1 = $wp_query; ?>

				<div class="tabbable woocommerce" id = 'catalog-list'> <!-- Only required for left/right tabs -->

		

		

						  <!--<ul class="nav nav-tabs">

							<li class="active"><a href="#tab1" data-toggle="tab">Розничные цены</a></li>

							<li><a href="#tab2" data-toggle="tab">Оптовые цены</a></li>

						  </ul>-->

						  <div class="tab-content">

							<div class="tab-pane active" id="tab1">

							  <table>

							 

							  <thead class = 'table table-bordered table-condensed table-hover'>

								<tr>

								  <!--<th >

									<span>No  </span>

									<a href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=_sku&order=asc' class = 'up'><span></span></a>

									<a href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=_sku&order=desc' class = 'down'><span></span></a>

								</th>-->

								  <th>

								  <div>

								  <span>Код  </span>

								  

									<!--<a title = 'Сортировать по возрастанию' href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=name&order=asc' class = 'up'><span></span></a>-->

									<!--<a title = 'Сортировать по убыванию' href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=name&order=desc' class = 'down'><span></span></a>-->

									</div>

								  </th>

								  <th><div>

								  <span>Размер  </span>

								  

									<!--<a  title = 'Сортировать по возрастанию' href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=size&order=asc' class = 'up'><span></span></a>-->

									<!--<a title = 'Сортировать по убыванию' href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=size&order=desc' class = 'down'><span></span></a>-->

									</div></th>

								  

								  <th><div>

								  <span>Тип  </span>

								  

									<!--<a href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=type&order=asc' class = 'up'><span></span></a>

									<a href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=type&order=desc' class = 'down'><span></span></a>-->

									</div></th>

								  <th>Фото</th>

								  <th><div><span>Наличие  </span>

									<!--<a href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=_stock&order=asc' class = 'up'><span></span></a>

									<a href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=_stock&order=desc' class = 'down'><span></span></a>-->

									</div>

									</th>

								  <th>

									<div>

								  <span>Цена  </span>

									<!--<a href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=_price&order=asc' class = 'up'><span></span></a>

									<a href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=_price&order=desc' class = 'down'><span></span></a>-->

									</div>

									</th>

								  <th><span>Примечание  </span>

									<!--<a href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=content&order=asc' class = 'up'><span></span></a>

									<a href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=content&order=desc' class = 'down'><span></span></a>--></th>

								  <th>Количество </th>

								</tr>

							  </thead>

							  <tbody>

							  

							  <?php 

							  

							  

							  

							  $products = get_sorted_products( $query1 );

							  

							  foreach( $products as $product) :

							

							  ?>

							  

							  <tr>

								  <!--<td><?php print $product->get_sku();?></td>-->

								  <td><?php print $product->post->post_title; ?></td>

								  

								  <td><?php print $product->get_attribute("size"); ?></td>

								  

								  <td><?php print $product->get_attribute("type"); ?></td>

								  <td><a class = 'photo' href = '<?php print home_url(); ?>/images/<?php print str_replace(" ","",trim($product->post->post_title)); ?>.jpg'><img src = '<?php  bloginfo('template_url'); ?>/img/photo.png' /></a></td>

								  

								  

								  <td><?php print $product->get_stock_quantity(); ?></td>

								  <td><?php print $product->get_price(); ?> руб. </td>

								  <td><?php print $product->post->post_content; ?> </td>

								  <td>

								  <div  class="cart" >

									<?php 

									

									

									

									

										$product_id 		= $product->post->ID;

										$cart_product_id 	= $woocommerce->cart->generate_cart_id ( $product_id );

										

										if( $woocommerce->cart->find_product_in_cart( $cart_product_id ) ) {

										

											$cart = $woocommerce->cart->get_cart( );

											$quantity  = $cart[ $cart_product_id ][ 'quantity' ];

										}

										else	

											$quantity = 0;

											

											

											

										$step	= apply_filters( 'woocommerce_quantity_input_step', '1', $product );

									$min 	= apply_filters( 'woocommerce_quantity_input_min', '', $product );

									$max 	= apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product );



									

										

									?>

										<div class = 'loading-layer' ></div>

										<div class="quantity buttons_added">

											<input title = 'Удалить с корзины' type="button" value="-" class="minus">

											<input type="number" step="<?php print $step; ?>" min="0" max="<?php print $max;  ?>" name="quantity" value="<?php print $quantity; ?>" title="Колличество" class="input-text qty text" data-product-id = '<?php print $product_id; ?>' data-cart-id = '<?php print $cart_product_id; ?>'>

											<input title = ' Добавить в корзину' type="button" value="+" class="plus">

										</div>



	 	



	 	

	</div>

								  </td>

								  

								</tr>

							  

							  <?php endforeach; ?>

							 	

							  </tbody>

							</table>

							  

							</div>

							

						  </div>

						</div>

				

				

				

				

				

				



				<?php //while ( have_posts() ) : the_post(); ?>



					<?php //woocommerce_get_template_part( 'content', 'product' ); ?>



				<?php //endwhile; // end of the loop. ?>



			<?php woocommerce_product_loop_end(); ?>



			<?php

				/**

				 * woocommerce_after_shop_loop hook

				 *

				 * @hooked woocommerce_pagination - 10

				 */

				do_action( 'woocommerce_after_shop_loop' );

			?>



		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>



			<?php woocommerce_get_template( 'loop/no-products-found.php' ); ?>



		<?php endif; ?>



	<?php

		/**

		 * woocommerce_after_main_content hook

		 *

		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)

		 */

		//do_action('woocommerce_after_main_content');

	?>

			</div><!-- /#primary -->

			<div class = 'clearfix'></div>

		</div><!-- /.page-wrapper -->

	</div><!-- /#middle -->



	<?php

		/**

		 * woocommerce_sidebar hook

		 *

		 * @hooked woocommerce_get_sidebar - 10

		 */

		//do_action('woocommerce_sidebar');

	?>



<?php get_footer('shop'); ?>