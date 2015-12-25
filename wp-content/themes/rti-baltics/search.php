<?php get_header(); ?>


	<div class="content-wrapper">
			<main class="content">


				

			<article class = 'main'> 
				

		<?php 
		global $wp_query, $woocommerce;
		global $post;	
		$a=str_replace("%2C",".",trim(($_GET['A'])));

		$b=trim(($_GET['B']));
		$s=str_replace(",",".",trim(($_GET['s1'])));
	//	$s=trim($s1);
		$s2=str_replace(",",".",trim(($_GET['s2'])));
		$s=$s.'*'.$s2;
		$s3=trim(($_GET['s3'])); 
if($a=="on") {
		if ($s<>'*'){
		//$sel="select * from $wpdb->postmeta where   meta_value LIKE 'ghgh'";

		//$cpt_query  = $wpdb->get_results( $sel, ARRAY_A );
$rr1=0;
//if ($cpt_query<>NULL){$rr=1;$rr1=1;} 
//else
//{
//$sel="select * from $wpdb->postmeta where    meta_value LIKE '".$s."'";
///$cpt_query  = $wpdb->get_results( $sel, ARRAY_A );if ($cpt_query<>NULL){$rr=0;$rr1=1;} 
//
///}




if ($rr1==0){
		
$p= explode("*", $s);
if (is_numeric($p[0])) {
$s1=$p[0].'%'.$p[1].'%';//17 30 7
$s2=($p[0]+0.5).'%'.$p[1].'%';//17 30 7
$s3=$p[0].'%'.($p[1]+1).'%';//17 31 7
$s4=($p[0]).'%'.($p[1]-1).'%';//17 29 7
$s5=($p[0]+1).'%'.($p[1]+1).'%';//18 31 7
$s6=($p[0]+1).'%'.($p[1]).'%';//18 30 7
$s7=($p[0]+1).'%'.($p[1]-1).'%';//18 29 7
$s8=($p[0]-1).'%'.($p[1]).'%';//17 29 7
$s9=($p[0]-1).'%'.($p[1]+1).'%';//17 29 7
$s10=($p[0]-1).'%'.($p[1]-1).'%';//17 29 7

$s11=($p[0]+1).'%'.$p[1].'%';//17 30 7
$s12=$p[0].'%'.($p[1]+1).'%';//17 31 7
$s13=($p[0]).'%'.($p[1]-1).'%';//17 29 7
$s14=($p[0]+1).'%'.($p[1]+1).'%';//18 31 7
$s15=($p[0]+1).'%'.($p[1]).'%';//18 30 7
$s16=($p[0]+1).'%'.($p[1]-1).'%';//18 29 7
$s17=($p[0]-1).'%'.($p[1]).'%';//17 29 7
$s18=($p[0]-1).'%'.($p[1]+1).'%';//17 29 7
$s19=($p[0]-1).'%'.($p[1]-1).'%';//17 29 7

$s20=$p[0].'%'.($p[1]+1).'%';//17 31 7
$s21=($p[0]).'%'.($p[1]-1).'%';//17 29 7
$s22=($p[0]+1).'%'.($p[1]+1).'%';//18 31 7
$s23=($p[0]+1).'%'.($p[1]).'%';//18 30 7
$s24=($p[0]+1).'%'.($p[1]-1).'%';//18 29 7
$s25=($p[0]-1).'%'.($p[1]).'%';//17 29 7
$s26=($p[0]-1).'%'.($p[1]+1).'%';//17 29 7
$s27=($p[0]-1).'%'.($p[1]-1).'%';//17 29 7

	//	add_filter("pre_get_posts", "myprefix_query_offset");
		//add_filter("found_posts", "myprefix_adjust_offset_pagination"); 
		//$query1 = new WP_Query(array('post_type' => 'product', 'post_status' => 'any', 'posts_per_page' => 99999) );  
/*
$args =array(
'post_type' => 'product',
  'meta_query'=> array(
      array(
          'key' => 'size',
          'compare' => 'LIKE', 
          'value' => '10'.%.'20*7',
       )
    ),

'post_per_page'=>5,'cache_results' => false 
);
  $cpt_query = NULL;
  $cpt_query = new WP_Query($args);*/
$sel="select * from $wpdb->postmeta where  meta_key='size' AND (  meta_value LIKE '".$s3."' OR  meta_value_num LIKE  '".$s4."'
OR meta_value LIKE '".$s5."' OR  meta_value LIKE '".$s6."'
OR meta_value LIKE '".$s7."' OR  meta_value LIKE '".$s8."'
OR meta_value LIKE '".$s9."' OR  meta_value LIKE '".$s10."'
OR meta_value LIKE '".$s11."' OR  meta_value LIKE '".$s12."'
OR meta_value LIKE '".$s13."' OR  meta_value LIKE '".$s14."'
OR meta_value LIKE '".$s15."' OR  meta_value LIKE '".$s16."'
OR meta_value LIKE '".$s17."' OR  meta_value LIKE '".$s18."'
OR meta_value LIKE '".$s19."' OR  meta_value LIKE '".$s20."'
OR meta_value LIKE '".$s21."' OR  meta_value LIKE  '".$s22."'
OR meta_value+0 LIKE '".$s2."' OR  meta_value LIKE  '".$s1."'

) ORDER BY meta_value desc";
$sel2="select * from $wpdb->postmeta where meta_key='size' AND ( meta_value+0='".$s1."') ORDER BY meta_value ";

$cpt_query  = $wpdb->get_results( $sel, ARRAY_A );
$cpt_query2  = $wpdb->get_results( $sel2, ARRAY_A );}
//var_dump($cpt_query2);
$cpt_query= array_merge ($cpt_query2, $cpt_query);
if ( $wp_error ) {
		return new WP_Error( 'db_query_error', 
			__( 'Could not execute query' ), $wpdb->last_error );}
			
			}
			
}}
else {$sel="SELECT DISTINCT  ID FROM $wpdb->posts as wposts, $wpdb->postmeta as wpostmeta WHERE    wposts.ID = wpostmeta.post_id AND wposts.post_status='publish' AND wposts.post_title LIKE '%".$s3."%'";		


	$cpt_query  = $wpdb->get_results( $sel, ARRAY_A );
	
	$sel2="SELECT DISTINCT  ID FROM $wpdb->posts as wposts, $wpdb->postmeta as wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key='analog' AND ( meta_value LIKE '%".$s3."%')";
	$cpt_query2  = $wpdb->get_results( $sel2, ARRAY_A );
if ($cpt_query2<>NULL){$rr3=1;} 
$cpt_query= array_merge ($cpt_query2, $cpt_query);
	$rr=1;$rr1=1;
}

		?>		

		<div class="tabbable woocommerce" id = 'catalog-list'> <!-- Only required for left/right tabs -->

		

		

						  <!--<ul class="nav nav-tabs">

							<li class="active"><a href="#tab1" data-toggle="tab">Розничные цены</a></li>

							<li><a href="#tab2" data-toggle="tab">Оптовые цены</a></li>

						  </ul>-->

						  <div class="tab-content">

							<div class="tab-pane active" id="tab1">

							  <table class="headt">

							 

							  <thead class = 'table table-bordered table-condensed table-hover'>

								<tr>

								  <!--<th >

									<span>No  </span>

									<a href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=_sku&order=asc' class = 'up'><span></span></a>

									<a href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=_sku&order=desc' class = 'down'><span></span></a>

								</th>-->
  <th>

								  <div>

								  <span>Назначение  </span>

								  

							
									</div>

								  </th>
								  <th>

								  <div>

								  <span>Код  </span>

								  

							
									</div>

								  </th>
<? if($rr3==1)  {?>
	  <th>

								  <div>

								  <span>Аналог  </span>

								  

							
									</div>

</th><? }?>
								  <th><div>

								  <span>Размер  </span>

								  

									<!--<a  title = 'Сортировать по возрастанию' href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=size&order=asc' class = 'up'><span></span></a>

									<!--<a title = 'Сортировать по убыванию' href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=size&order=desc' class = 'down'><span></span></a>-->

									</div></th>

								  

								  <th><div>

								  <span>Тип  </span>

								  

									<!--<a href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=type&order=asc' class = 'up'><span></span></a>

									<a href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=type&order=desc' class = 'down'><span></span></a>-->

									</div></th>
<!-- <th><div>

								  <span>Бренд  </span>

								  

									<a href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=type&order=asc' class = 'up'><span></span></a>

									<a href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=type&order=desc' class = 'down'><span></span></a>

									</div></th> -->
								  <th><div><span>Фото</span></div></th>

								  <th><div><span>Наличие  </span>

									<!--<a href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=_stock&order=asc' class = 'up'><span></span></a>

									<a href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=_stock&order=desc' class = 'down'><span></span></a>-->

									</div>

									</th>
	  <th>

									<div>

								  <span>Цена Опт  </span>

									<!--<a href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=_price&order=asc' class = 'up'><span></span></a>

									<a href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=_price&order=desc' class = 'down'><span></span></a>-->

									</div>

									</th>
								  <th>

									<div>

								  <span>Цена от 1шт. </span>

									<!--<a href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=_price&order=asc' class = 'up'><span></span></a>

									<a href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=_price&order=desc' class = 'down'><span></span></a>-->

									</div>

									</th>

								  <th><div><span>Инфо  </span>

									<!--<a href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=content&order=asc' class = 'up'><span></span></a>

									<a href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=content&order=desc' class = 'down'><span></span></a>--></div></th>

								  <th><div><span>Количество</span> </div></th>

								</tr>

							 

							

							  

							<?php 

					  $query=$cpt_query;
					echo "Поисковый запрос: ".$s3."<br/>";
if ( $query)
{
	foreach ( $query as $post )
	{
if ($rr==1) 	$post = get_post( intval( $post['ID'] ) );
if ($rr==0) 	$post = get_post( intval( $post['post_id'] ) );

setup_postdata( $post );?>
		
		<? 
$ss=$product->get_attribute("size");;$ss2=strpos('_' .$ss,$s);
if ($ss2 !== False) {?>
		
							  <tr>
<td><? $naz=$product->get_attribute("naznachenie");
if ($naz=="") echo "Сальник"; else echo $naz;
?> </td>

								  <!--<td><?php //print $product->get_sku();?></td>-->

								  <td><a href="<?;echo get_permalink($product->id);?>" target="_blank" style="color:#000;"><?php print $product->post->post_title; ?></a></td>
<? if($rr3==1)  {?>
	<td><B>
<? echo $s3;?></b>
</td>	<?} ?>						  

								  <td>

<? 
$ss=$product->get_attribute("size");;$ss2=strpos('_' .$ss,$s);
if ($ss2 !== False) echo "<b>";?>
<?php print $ss; ?></b></td>

								  

								  <td><?php print $product->get_attribute("type"); ?></td>
								  <!-- <td><?php $pp=$product->get_attribute("Proizvoditel"); if ($pp=="") echo "TCS"; else echo $pp;?></td> -->

								  <td><a class = 'photo' rel="external me lightbox" href = '<?php print home_url(); ?>/images/<?php print trim($product->post->post_title); ?>.jpg' ><img src = '<?php  bloginfo('template_url'); ?>/img/photo.png' /></a></td>

								  

								  

								  <td><?php print $product->get_stock_quantity(); ?></td>
								  <td><?php $pr=$product->get_price();print  round($pr*0.7); ?> руб. </td>

								  <td><?php print $product->get_price(); ?> руб. </td>

								<td><a href="<?;echo get_permalink($product->id);?>" target="_blank"  class="0" ><img src="/wp-content/themes/rti-baltics/img/1.png" title="Дополнительная информация"/><?php //print $product->post->post_content; ?></a> </td>

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

							  
<?php

}




	}
	
}
			  


					  $query=$cpt_query;
					
if ( $query)
{
	foreach ( $query as $post )
	{
if ($rr==1) 	$post = get_post( intval( $post['ID'] ) );
if ($rr==0) 	$post = get_post( intval( $post['post_id'] ) );

setup_postdata( $post );?>
		
		<? 
$ss=$product->get_attribute("size");;$ss2=strpos('_' .$ss,$s);
if ($ss2 == False) {?>
		
							  <tr>
<td><? $naz=$product->get_attribute("naznachenie");
if ($naz=="") echo "Сальник"; else echo $naz;
?> </td>
								  <!--<td><?php //print $product->get_sku();?></td>-->

								  <td><a href="<?;echo get_permalink($product->id);?>" target="_blank" style="color:#000;"><?php print $product->post->post_title; ?></a></td>

								<? if($rr3==1)  {?>
	<td><B>
<? echo $s3;?></b>
</td>	<?} ?>	  

								  <td>

<? 
$ss=$product->get_attribute("size");;$ss2=strpos('_' .$ss,$s);
if ($ss2 !== False) echo "<b>";?>
<?php print $ss; ?></b></td>

								  

								  <td><?php print $product->get_attribute("type"); ?></td>
								  <!-- <td><?php $pp=$product->get_attribute("Proizvoditel"); if ($pp=="") echo "TCS"; else echo $pp;?></td> -->

								  <td><a class = 'photo' rel="external me lightbox"  href = '<?php print home_url(); ?>/images/<?php print trim($product->post->post_title); ?>.jpg'><img src = '<?php  bloginfo('template_url'); ?>/img/photo.png' /></a></td>

								  

								  

								  <td><?php print $product->get_stock_quantity(); ?></td>
								  <td><?php $pr=$product->get_price();print  round($pr*0.7); ?> руб. </td>

								  <td><?php print $product->get_price(); ?> руб. </td>

								<td><a href="<?;echo get_permalink($product->id);?>" target="_blank" class="0" ><img src="/wp-content/themes/rti-baltics/img/1.png" title="Дополнительная информация"/><?php //print $product->post->post_content; ?></a> </td>

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

							  
<?php

}




	}
	
}
			  
		

								remove_filter("found_posts", "myprefix_adjust_offset_pagination"); 

		

							remove_filter("pre_get_posts", "myprefix_query_offset"); ?>

							 	

							  </tbody>

							</table>

							  

							</div>

							

						  </div>

						</div>

							
</main>
		
				<div id = 'secondary' class = 'widgets-area left'>

				

					<?php get_sidebar(); ?>

					

					

				</div><!-- /#secondary -->	
				</div><!-- /#primary-->

				

			

				

			</div>

		

	
<?php get_footer(); ?>