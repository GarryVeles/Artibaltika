<?php	
	
	/**
	 * Posts Hortcode
	 */
	 function catalog_shortcode($atts) {
	
		
		ob_start();
		
		
		global $wp_query, $woocommerce;
		
		global $post;
		add_filter("pre_get_posts", "myprefix_query_offset");
					  
		add_filter("found_posts", "myprefix_adjust_offset_pagination"); 
		
$tt=$_GET['order_by'];//'product_cat'=>'rezinovye-kolca', 
$yy=$_GET['ttp'];$mm="meta_value_num";
$filt=$_GET['country_id']." ".$_GET['region_id'];//'product_cat'=>'rezinovye-kolca', 

if ($yy<>2 && $yy<>1) {$cat='salniki-rulevyx-reek';$mm="meta_value";}
$filt=$_GET['country_id']." ".$_GET['region_id'];//'product_cat'=>'rezinovye-kolca', 

if ($yy==2) {$cat='salniki-razlichnogo-primeneniya';$mm="meta_value+0";}
if ($yy==1) {$cat='remrulreek'; $mm="meta_value"; }
if ($yy==3) {$cat='salniki-amortizatorov'; }
if ($yy==4) {$cat='rezinovye-kolca'; }
if ($yy==5) {$cat='podshipniki'; }
if ($yy==6) {$cat='vtulki'; }
if ($yy==7) {$cat='pilniki'; }
if ($yy==8) {$cat='comprcond'; }
if ($yy==9) {$cat='gaiki'; }
if ($yy==10) {$cat='podzimi'; }
if ($yy==11) {$cat='poshipnik'; }
if ($yy==12) {$cat='porshni'; }
if ($yy==13) {$cat='teflon'; }


if ($tt=='') $tt='size';
if ($tt=='' && $yy==1){ $tt="name";}
if ($tt=='size' ){ $tt="size";}
if ($tt=='type'){ $tt="type";}
if ($tt=='name') $tt='post_title';

//if ($yy==1) $query1 = new WP_Query(array('post_type' => 'product',  'post_status' => 'Published','product_cat'=>'rezinovye-kolca') ); 
//if ($yy==2) $query1 = new WP_Query(array('post_type' => 'product',  'post_status' => 'Published','product_cat'=>'salniki-razlichnogo-primeneniya') ); 

//if ($yy<>2 && $yy <> 1) $query1 = new WP_Query(array('post_type' => 'product',  'post_status' => 'Published','product_cat'=>'salniki-rulevyx-reek','order'=>'ASC') );  

//$query1 = new WP_Query(array('post_type' => 'product',  'post_status' => 'Published','product_cat'=>'salniki-rulevyx-reek') );  
 //wp_reset_query();$query1= null;

 if ($tt=='size') { 
$ee=array('post_type' => 'product', 'post_status' => 'Published','order'=>'ASC','product_cat'=>$cat,'orderby'  => $mm,'meta_key' => 'size');}
else {
 if ($tt=='type') {
$ee=array('post_type' => 'product', 'post_status' => 'Published','order'=>'ASC','product_cat'=>$cat,'orderby'  => 'meta_value','meta_key' => 'tip' );
}

else{
$ee=array('post_type' => 'product', 'post_status' => 'Published','order'=>'ASC','product_cat'=>$cat,'orderby'  => 'title');

}}

if ($_GET['country_id']<>''){
	
$ee=array('post_type' => 'product', 'post_status' => 'Published','order'=>'ASC','product_cat'=>'remrulreek','orderby'  => $mm,'meta_key' => 'size','meta_query'=> array(
          'key' => 'size',
          
          'value' => $filt         ));	

}
//var_dump($ee);;
 $query1 = new WP_Query($ee ); 
 //var_dump($query1);
//var_dump($query1);

/* if ($_GET['order_by']=='size') {		
$query1 = new WP_Query(array('post_type' => 'product', 'post_status' => 'Published','orderby'=> 'meta_value','order'=>'ASC','meta_key' => 'size','product_cat'=>$cat) ); 

if ($_GET['order']=='desc'){		$query1 = new WP_Query(array('post_type' => 'product', 'post_status' => 'Published','orderby'=> 'meta_value_num','meta_key' => 'size','order'=>'DESC','product_cat'=>'salniki-rulevyx-reek') ); 
}		
if ($_GET['order']=='asc'){		$query1 = new WP_Query(array('post_type' => 'product', 'post_status' => 'Published','orderby'=> 'meta_value_num','meta_key' => 'size','order'=>'ASC','product_cat'=>'salniki-rulevyx-reek') );
}	 }*/
		
								
	?>
	
	
	
<?
function get_product_category_by_slug($cat_slug)
{
    $category = get_term_by('slug', $cat_slug, 'product_cat', 'ARRAY_A');
return $category['name'];}


echo "<header>".get_product_category_by_slug($cat)."</header>";

?>
		<div class="tabbable woocommerce" id = 'catalog-list'> <!-- Only required for left/right tabs -->
								  <!--<ul class="nav nav-tabs">
							<li class="active"><a href="#tab1" data-toggle="tab">Розничные цены</a></li>
							<li><a href="#tab2" data-toggle="tab">Оптовые цены</a></li>
						  </ul>-->
						  
						  <style>
 .sell  td{vertical-align: middle!important; padding:3px;text-align:center; font-size:18px;
   }
   .sell select{font-size:15px;}
    #selectBoxInfo{
    clear:left;
    padding:10px;
  }
	</style>
			<?php
if (($cat=='remrulreek') OR ($_GET['country_id']<>'')){ ?>			<div class="sell">
						  <table  align="center" style='margin-top:20px'>
<tr><td style='background:#67859A;;color:#fff;'>Фильтр по автомобилю</td>
	<td width=250px><form action="/katalog/" method="get">
			Марка: 
			<select name="country_id" id="country_id" class="StyleSelectBox">
				<option value="0">- выберите марку -</option>
				<option value="ALFA ROMEO">ALFA ROMEO</option>
				<option value="AUDI">AUDI</option>
				<option value="BMW">BMW</option>
				<option value="CADILLAC">CADILLAC</option>
				<option value="CHEVROLET">CHEVROLET</option>
				<option value="CHRYSLER">CHRYSLER</option>
				<option value="Daewoo">DAEWOO</option>
				<option value="Dodge">Dodge</option>
				<option value="FIAT">FIAT</option>
				<option value="FORD">FORD</option>
				<option value="Honda">Honda</option>
				<option value="Hyundai">Hyundai</option>
				<option value="Infiniti">Infiniti</option>
				<option value="Iveco">Iveco</option>
				<option value="Jeep">Jeep</option>
				<option value="Kia">Kia</option>
				<option value="Lada">Lada</option>
				<option value="Land Rover">Land Rover</option>
				<option value="Lexus">Lexus</option>
				<option value="Lincoln">Lincoln</option>
				<option value="Mazda">Mazda</option>
				<option value="Mercedes">Mercedes</option>
				<option value="Mitsubishi">Mitsubishi</option>
				<option value="Nissan">Nissan</option>
				<option value="Opel">Opel</option>
				<option value="Peugeot">Peugeot</option>
				<option value="Renault">Renault</option>
				<option value="Skoda">Skoda</option>
				<option value="SSANGYONG">SSANGYONG</option>
				<option value="Subaru">Subaru</option>
				<option value="Suzuki">Suzuki</option>
				<option value="Toyota">Toyota</option>
				<option value="Vauxhall">Vauxhall</option>
				<option value="VOLVO">VOLVO</option>
				<option value="VW">VW</option>
			</select></td><td width=250px>
			Модель:	<select name="region_id" id="region_id" disabled="disabled" class="StyleSelectBox">
				<option value="0">- выберите модель -</option>
			</select></td><td>
		<td  style="">
		<input type="submit" value="Поиск" style="font-size:16px;"/>
		</td>
			
		</form></td>
</tr>
</table><br />
<div align="center" id="selectBoxInfo"></div>

						  </div>
						  
<? }?>
						  <center style="font-size: 14px;"> Внимание: Цены в корзине изменятся на оптовые, когда сумма заказа достигнет 8 000 рублей по розничным ценам (8 000 >>> 5000)</center>
						  <div class="tab-content">
							<div class="tab-pane active" id="tab1">
							  <table  class="t1 table table-bordered table-condensed table-hover">
							 <thead class="table table-bordered table-condensed table-hover headt">
							
								<tr > <th style="font-size:16px;" width="194px">Наименование</th>
								  <th>
								  <div>
								  <span>Код  </span>
								    <?
								  if ($_GET['order']=='asc') $or1='desc';
								  else $or1='asc';
$or1='asc';
								  ?>
									<a title = 'Сортировать по возрастанию' href = '?ttp=<?=$yy;?>&order_by=name&order=<?=$or1;?>'' class = 'up'><span></span></a>
									<!--<a title = 'Сортировать по убыванию' href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=name&order=desc' class = 'down'><span></span></a>-->
									</div>
								  </th>
								  <th><div>
								  <span><? if ($yy==1) {echo "Марка Авто"; }
								  else {echo "Размер";}?> </span>
								  <?
								  
								  if ($_GET['order']=='desc') $or='asc';
								  else $or='desc';
$or='asc';
								  ?>
								<? if ($yy==1000) {?>
								<a   href = '?ttp=<?=$yy;?>&order_by=marka&order=<?=$or;?>' class = 'up'><span></span></a>

								<? } else {?>
								<a   href = '?ttp=<?=$yy;?>&order_by=size&order=<?=$or;?>' class = 'up'><span></span></a>
								<? }?>
									</div></th>
								  
								  <th><div>
								  <span><? if ($yy==1) {echo "Год Выпуска"; }
								  else {echo "Тип";}?>  </span>
								  
									  <?
								  
								  if ($_GET['order']=='desc') $or='asc';
								  else $or='desc';
$or='asc';
								  ?>
								  <? if ($yy==1000) {?>
									<a  title = 'Сортировать по возрастанию' href = '?ttp=<?=$yy;?>&order_by=god&order=<?=$or;?>' class = 'up'><span></span></a>
									<? } else {?>
	<a  title = 'Сортировать по возрастанию' href = '?ttp=<?=$yy;?>&order_by=type&order=<?=$or;?>' class = 'up'><span></span></a>								<? }?>
									</div></th>
																	  <!-- <th ><div><span>Бренд</span></div></th> -->

								  <th ><div><span>Фото</span></div></th>
								  <th><div><span>Наличие  </span>
									<!--<a href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=_stock&order=asc' class = 'up'><span></span></a>
									<a href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=_stock&order=desc' class = 'down'><span></span></a>-->
									</div>
									</th>
							
  <th width="70">
									<div>
								  <span>Цена Опт</span>
								</div>
									</th>	  <th >
									<div>
								  <span>Цена от 1шт.  </span>
									<!--<a href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=_price&order=asc' class = 'up'><span></span></a>
									<a href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=_price&order=desc' class = 'down'><span></span></a>-->
									</div>
									</th>
								  <th><div><span>Инфо</span>
									<!--<a href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=content&order=asc' class = 'up'><span></span></a>
									<a href = '?cat_page=<?php print isset($_GET['cat_page']) ?  $_GET['cat_page']: "1"; ?>&order_by=content&order=desc' class = 'down'><span></span></a>--></div></th>
								  <th><div><span>В корзину</span> </div></th>
								</tr>
							</thead>
							  <?php 
							  							  
if ($query1->have_posts()) : ?><?php while ($query1->have_posts()) : $query1->the_post(); 
global $product;						  ?>
							  
							  <tr>  <td style="font-size: 16px;"><? $naz= $product->get_attribute("Naznachenie");if ($naz=="") echo "Сальник"; else echo $naz;
?></td>
								  <td ><a href="<?;echo get_permalink($product->id);?>" target="_blank" style="color:#000;"><?php print $product->post->post_title; ?></a></td>
								  
								  <td ><? if ($yy==1) {print $product->get_attribute("marka"); }
								  else {print $product->get_attribute("size");}?></td>
								  
								  <td ><? if ($yy==1) {print $product->get_attribute("god"); }
								  else {print $product->get_attribute("type");}?></td>
								   <!-- <td ><? if ($yy==1) {//print $product->get_attribute("god");
								   $proz=$product->get_attribute("Proizvoditel");if ($proz=="") echo "TCS"; else echo $proz;
								   }
								  else {$proz=$product->get_attribute("Proizvoditel");if ($proz=="") echo "TCS"; else echo $proz;
								  
								  }?></td> -->
								  <td  ><a class = 'photo' href = '<?php print home_url(); ?>/images/<?php print $product->post->post_title; ?>.jpg' rel="external me lightbox"><img src = '<?php  bloginfo('template_url'); ?>/img/photo.png' /></a></td>
								  
								  
								  <td ><?php print $product->get_stock_quantity(); ?></td>
								  <td ><?php $pp=$product->get_price(); echo round($pp*0.7); ?> руб. </td>							
	  <td width="70"><?php print $product->get_price(); ?> руб. </td>

								   <td ><a href="<?;echo get_permalink($product->id);?>" onlick="window.open('<?;echo get_permalink($product->id);?> ','','Toolbar=1,Location=0,Directories=0,Status=0,Menubar=0,Scrollbars=0,Resizable=0,Width=500,Height=500');"  class="0" target="_blank" ><img src="http://rti-baltika.ru/wp-content/themes/rti-baltics/img/1.png" title="Дополнительная информация"/><?php //print $product->post->post_content; ?></a> </td>
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
							  
							  <?php endwhile; ?>
							 	<?php else : ?><h2>Объектов пока что нет в нашей базе</h2>
<?php endif;?>
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
		
		
		remove_filter("found_posts", "myprefix_adjust_offset_pagination"); 
		
		remove_filter("pre_get_posts", "myprefix_query_offset");
		
	
	
		return ob_get_clean();
	}
	add_shortcode("catalog", "catalog_shortcode");
	
	
	
?>