<?php get_header(); ?>

<div id = 'middle'>

			<div class = 'page-wrapper'>

				<div id = 'secondary' class = 'widgets-area left'>

				

					<?php get_sidebar(); ?>

					

					

				</div><!-- /#secondary -->

				

				<div id = 'primary' class = 'right'>

					

					<nav class = 'breadcrumbs'>

		

						<?php if(function_exists('bcn_display')) bcn_display() ?>

						

					</nav>

					

					<?php while(have_posts()): the_post();?>

					

					<article class = 'main'> 

					

						<header>

							<h2><?php the_title(); ?></h2>

						</header>

		<?				
$query1 = new WP_Query(array('product_cat'=>'rezinovye-kolca'));  


		
								
	?>
	
		<nav class = 'pagination'>
			<?php my_pagination(array( 'total_items' => $query1->found_posts)); ?>
		</nav>
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
								  
									<a title = 'Сортировать по возрастанию' href = '?order_by=name&order=asc' class = 'up'><span></span></a>
									<!--<a title = 'Сортировать по убыванию' href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=name&order=desc' class = 'down'><span></span></a>-->
									</div>
								  </th>
								  <th><div>
								  <span>Размер  </span>
								  
									<a  title = 'Сортировать по возрастанию' href = '?order_by=size&order=asc' class = 'up'><span></span></a>
									<!--<a title = 'Сортировать по убыванию' href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=size&order=desc' class = 'down'><span></span></a>-->
									</div></th>
								  
								  <th><div>
								  <span>Тип  </span>
								  
									<!--<a href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=type&order=asc' class = 'up'><span></span></a>
									<a href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=type&order=desc' class = 'down'><span></span></a>-->
									</div></th>
								  <th><div><span>Фото</span></div></th>
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
								  <th><div><span>Примечание  </span>
									<!--<a href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=content&order=asc' class = 'up'><span></span></a>
									<a href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=content&order=desc' class = 'down'><span></span></a>--></div></th>
 
								  <th><div><span>Количество</span> </div></th>
								</tr>
							  </thead>
							  <tbody>
							  
							  <?php 
							  
							  
							  
							  $products = get_sorted_products( $query1 );
							  
							  foreach( $products as $product) :
							
							//echo $product->id;
							//var_dump($product); ?>
							  <tr>
								  <!--<td><?php print $product->get_sku();?></td>-->
								  <td><?php print $product->post->post_title; ?></td>
								  
								  <td><?php print $product->get_attribute("size"); ?></td>
								  
								  <td><?php print $product->get_attribute("type"); ?></td>
								  <td><a class = 'photo' href = '<?php print home_url(); ?>/images/<?php print $product->post->post_title; ?>.jpg'><img src = '<?php  bloginfo('template_url'); ?>/img/photo.png' /></a></td>
								  
								  
								  <td><?php print $product->get_stock_quantity(); ?></td>
								  <td><?php print $product->get_price(); ?> руб. </td>
								  <td><a href="<?;echo get_permalink($product->id);?>" title="<?php  echo $product->get_attribute("proiz"); ?>" class="0">[ П ]</a><a href="<?;echo get_permalink($product->id);?>" title="<?php  echo $product->get_attribute("naznachen"); ?>" class="0">[ Н ]</a><a href="<?;echo get_permalink($product->id);?>" title="<?php  echo $product->get_attribute("prim"); ?>">[ П ]</a><a href="<?;echo get_permalink($product->id);?>" title="<?php  echo $product->get_attribute("analog"); ?>" class="0">[ А ]<? echo '<script type="text/javascript">'; echo "$('.0').popupWindow({ height:500,width:900, top:50, left:50 });</script>";?></a></td>
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
											<input type="number" step="<?php print $step; ?>" min="0" max="<?php print $max;  ?>" name="quantity" value="<?php print $quantity; ?>" title="Количество" class="input-text qty text" data-product-id = '<?php print $product_id; ?>' data-cart-id = '<?php print $cart_product_id; ?>'>
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
						
						
		<nav class = 'pagination'>
			<?php my_pagination(array( 'total_items' => $query1->found_posts)); ?>
		</nav>

<?php

		wp_reset_postdata(); 
		wp_reset_query();
		?>

						

					</article><!-- /article.main -->

					

					<?php endwhile; ?>

					

				</div><!-- /#primary-->

				

				<div class = 'clearfix'></div>

				

			</div>

		

		</div>

<?php get_footer(); ?>