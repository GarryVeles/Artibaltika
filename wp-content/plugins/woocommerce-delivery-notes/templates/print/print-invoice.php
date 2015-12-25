<!DOCTYPE html>
<html class="<?php echo wcdn_get_template_type(); ?>">
<head>
	<meta charset="utf-8">
	<title><?php wcdn_template_title(); ?></title>
	<?php wcdn_head(); ?>
	<link rel="stylesheet" href="<?php wcdn_stylesheet_url( 'style.css' ); ?>" type="text/css" media="screen,print" />
	<style type="text/css">
		/* Simple CSS Reset and Print options
------------------------------------------*/


html, body, div, span, h1, h2, h3, h4, h5, h6, p, a, table, ol, ul, dl, li, dt, dd {
	border: 0 none;
	font: inherit;
	margin: 0;
	padding: 0;
	vertical-align: baseline;
}

body {
	line-height: 1;
}

ol,
ul {
	list-style: none;
}

table {
	border-collapse: collapse;
	border-spacing: 0;
}


/* Template Page Layout
------------------------------------------*/


/* Main Body */
body {
	background: #fff;
	color: #000;
	font-family: "HelveticaNeue", Helvetica, Arial, sans-serif;
	font-size: 0.575em;
	line-height: 125%;
}

h1,
h2,
h3,
h4 {
	font-weight: bold;
}

li,
ul {
	margin-bottom: 1.25em;
}

p + p {
	margin-top: 1.25em;
}

/* Basic Table Styling */
table {
	page-break-inside: auto;
}

tr {
	border-top: 1px #ccc solid;
	border-bottom: 1px #ccc solid;
	page-break-inside: avoid;
	page-break-after: auto;	
}

td,
th {
	border-left: 1px #ccc solid;
	border-right: 1px #ccc solid;
	padding: 0.075em 0.375em;
	vertical-align: middle;
}

th {
	color: #000;
	font-weight: bold;
	text-align: left;
}

/* Special Margin & Overflow Stylings */
#page {
	margin-left: auto;
	margin-right: auto;
	padding-top: 5%;
	padding-bottom: 5%;
	padding-left: 10%;
	padding-right: 10%;
	text-align: left;
/* 	page-break-after: always;	 */
}

#letter-header,
#order-items,
#order-summary,
#order-notes {
	margin-bottom: 3em;
}

#order-info,
#order-summary {
	margin-bottom: 1.0em;
}

#page,
#letter-header,
#order-listing,
#order-summary,
#order-notes,
#letter-footer {
	overflow: hidden;
}

#order-items,
#order-summary,
#order-notes {
	page-break-before: auto;
	page-break-after: auto;
}

/* Delivery Notes Head */
#letter-header .heading {
	float: left;
	width: 100%;
	font-weight: bold;
	font-size: 2em;
	text-decoration: underline;
	line-height: 125%;
	white-space: nowrap;
}

#letter-header .company-name {
	font-weight: bold;
}

#letter-header .company-info {
	float: right;
	width: 50%;
	margin-top: 0.45em;
}

/* Order Listing - #order-listing */
#order-listing {
	float: right;
	width: 50%;
}

/* Order Info - #order-info */
#order-info {
	float: left;
	width: 50%;
}

/* Order Items - #order-items */
#order-items {
	clear: both;
}

#order-items table {
	width: 100%;
}

#order-items .description {
	width: 50%;
}

#order-items .price {
	width: 25%;
}

#order-items dl {
	display: inline;
	margin-bottom: 0;
	color: #666;
}

#order-items dt,
#order-items dd {
	display: inline;
	margin-bottom: 0;
	font-size: 0.75em;
}
#order-items dt {
	margin-left: 0.75em;
}

#order-items dd {
	margin-left: 0.2em;
}

/* Order Summary - #order-summary */
#order-summary {
	float: right;
	width: 50%;
}

#order-summary table {
	width: 100%;
	page-break-inside: avoid;
}

#order-summary .price {
	width: 50%;
}

#order-summary tr:last-child {
	border-top: 2px solid #000;
	border-bottom: 2px solid #000;
	font-weight: bold;
}

#order-summary small,
#order-summary .includes_tax {
	font-size: 0.75em;
	color: #666;
}

/* Order Notes - #order-notes */
#order-notes {
	clear: both;
}
#order-notes .notes-shipping {
	float: left;
	width: 50%;
}
#order-notes .notes-personal {
	float: right;
	width: 50%;
	font-weight: bold;
}

/* Footer Imprint */
#letter-footer {

	padding-top: 1em;
	color: #666;
	font-size: 0.75em;
}

#letter-footer p + p {
	margin-top: 1em;
}

#letter-footer .policies,
#letter-footer .imprint {
	margin-bottom: 1em;
}


/* CSS Media Queries for Print
------------------------------------------*/



#info { border: 4px solid black; width: 100%; margin: 30px 0px;}
#info .line { border-top: 1px solid black; }

		
		
	</style>
</head>
<body>
	<div id="container">
		<?php wcdn_navigation(); ?>
		<div id="content">
			<div id="page">	<?  $oo=$_GET['ooo'];?>
				<div id="letter-header">
					<div class="heading"><?php if( wcdn_get_company_logo_id() ) : ?><?php wcdn_company_logo(); ?><?php else : ?><?php wcdn_template_title(); ?> №<?php wcdn_order_number(); ?> от <?php wcdn_order_date(); ?><?php endif; ?></div>
					<div class="company-info">
						<div class="company-name"><?php //wcdn_company_name(); ?></div>
						<div class="company-address"><?php //wcdn_company_info(); ?></div>
					</div>
				</div><!-- #letter-header -->
				
				<div id="order-listing">
					
				</div><!-- #order-listing -->
				
				<ul id="order-info">
					
					<li>
					
						<h3 class="order-date-label">Поставщик:</h3>
							<? if ($oo<>1) {?><span class="order-date"><?php wcdn_company_info(); ?></span>
							<?} else {?>
							ООО «РТИ-Техника» ИНН/КПП: 3906959000/390601001
							Юридический адрес: 236022, г.Калининград, ул. Зоологическая,д.44/6

							<? }?>
					</li>
					
					<li>
						<h3 class="order-payment-label">Покупатель:</h3>
						<?php 
								global $wcdn;
								
								print  $wcdn->print->get_order()->shipping_company
							?>
					</li>
					
				</ul><!-- #order-info -->
				
				<div id="order-items">
					<table>
						<thead>
							<tr>
								<th class="product-no">No</th>
<th class="product-no">SKU</th>								<th class="product-type">Наименование</th>

								<th class="1product-label">Код</th>
								<th class="product-size">Размер</th>
								<th class="product-type">Тип</th>
								<th class="product-type">Бренд</th>

								<th class="quantity-label">Кол-во</th>
								<th class="quantity-label">Ед.</th>
								<th class="single-price-label">Цена.</th>
								<th class="totals-label">Сумма.</th>
							</tr>
						</thead>
						<tbody>
							<?php 	
							$product_counter = 0;
							
							function myCmp($a, $b) { 
if ($a['sku'] === $b['sku']) return 0; 
return $a['sku'] > $b['sku'] ? 1 : -1; 
} 
$totals = wcdn_get_order_totals(); ;$sum=$totals['order_total']['value'];
							$sum=str_replace("руб.",'',$sum); $a = strip_tags($sum); $sum=(int)$a+1-1  ;    
							$items = wcdn_get_order_items();
							if( sizeof( $items ) > 0 ) 
{
uasort($items , 'myCmp');
					
		foreach( $items as $item ) : 	
$rr=$item['single_price']*$item['quantity']+$rr;

endforeach;  		
		foreach( $items as $item ) : ?><tr>
							
								<td class = 'number'><?php print ++$product_counter; ?></td>
								<td class = 'number'><?php print $item['sku']; ?></td>
								<td class = 'number'><?php print $item['product']->get_attribute('naznachenie') ?></td>

								<td class="description"><?php echo $item['name']; ?>
									<?php echo $item['meta']; ?>
									<!--<dl class="meta">
										<?php if( !empty( $item['sku'] ) ) : ?><dt><?php _e( 'SKU:', 'woocommerce-delivery-notes' ); ?></dt><dd><?php echo $item['sku']; ?></dd><?php endif; ?>
										<?php if( !empty( $item['weight'] ) ) : ?><dt><?php _e( 'Weight:', 'woocommerce-delivery-notes' ); ?></dt><dd><?php echo $item['weight']; ?><?php echo get_option('woocommerce_weight_unit'); ?></dd><?php endif; ?>
									</dl>-->
								</td>
								<td class = 'size'><?php  print $item['product']->get_attribute('size')  ?></td>
								<td class = 'type'><?php  print $item['product']->get_attribute('type')  ?></td>
								<td class = 'number'><?php print $item['product']->get_attribute('Proizvoditel') ?></td>

								<td class="quantity"><?php echo $item['quantity']; ?></td>
								<td class="units">шт.</td>
								<td class="single-price"><?php  if($rr>10000) {$s=$item['single_price']; print ($s*0.7);}else {echo $item['single_price'];}?>руб.</td>
								<td class="totals"><?php  print $item['line_total'] ?>руб.</td>
							</tr><?php endforeach;  }?>
							
							
							
							<tr><td colspan="7" class = 'shipping-cost'>Доставка</td><td> <?php $totals = wcdn_get_order_totals(); print  str_replace("через Доставка", "", $totals['shipping']['value']); ?></td></tr>
						</tbody>
					</table>
				</div><!-- #order-items -->
				
				<div id="order-summary">
					
					<table>
					
						<tfoot>
							
							<tr>
								<th class="description">Итого: </th>
								<td class="price"><?php echo "Скидка: ";echo $totals['order_discount']['value'];  echo "<br/>".$totals['order_total']['value'];?></td>

							</tr>
							
						</tfoot>
					</table>
				</div><!-- #order-summery -->
				
				<div style = 'clear: both;'></div>
				<div>
					
					<?php printf("Всего наименований %d на сумму  %s", $product_counter, $totals['order_total']['value']  );?>
					<br/><br/><br/><br/>
				</div>
				
				
				<div><strong>___________________________________________________________________________________________________________</strong></div>
				<br/><br/>
				<div style = 'width: 100%'>
					<div style = 'width: 55%; float: left'>
					<strong>Отпустил  ___________</strong>
					</div>
					<div style = 'width: 40%; float: right'>
					<strong>Получил  ___________</strong>
					</div>
					<div style = 'clear: both;'></div>
			</div>
				
	
				<div id="order-notes">
					<div class="notes-shipping">
					
						<?php if ( wcdn_get_shipping_notes() ) : ?>
						<!-- 	<h3><?php //_e( 'Customer Notes', 'woocommerce-delivery-notes' ); ?></h3>-->
						<!--<?php //wcdn_shipping_notes(); ?>-->
						<?php endif; ?>
					</div>
					<div class="notes-personal"><?php wcdn_personal_notes(); ?></div>
				</div><!-- #order-notes -->
					
					<div id="letter-footer">
					<? if ($oo==1) {?>
						
						<div class="policies"><strong>Генеральный директор OOO "РТИ-Техника" __________________________ (Иголкина А. А.)</strong></div>
						
						
						<?} else {
						?>
							<div class="policies"><strong>Генеральный директор OOO "РТИ-Балтика" __________________________ (Иголкин А.В.)</strong></div>

						<? }?>
						
					</div><!-- #letter-footer -->
				
				
				
			</div><!-- #page -->
		</div><!-- #content -->
	</div><!-- #container -->
</body>
</html>