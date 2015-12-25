<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
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

				<div id = 'secondary' class = 'widgets-area left'>

				

					<?php 		do_action('woocommerce_sidebar');
 ?>

					

					

				</div><!-- /#secondary -->

				<div id = 'primary' class = 'right'>


				
<article class="main">
		<?php while ( have_posts() ) : the_post(); ?><?

$terms = get_the_terms( $post->ID, 'product_cat' ); 
if ($terms[21]->slug=="remrulreek") $r=1; 
if ($r<>1){
echo "<br/><h1>Сальник рулевой рейки ";	the_title(); echo "</h1>";}
else {
echo "<br/><h1>Ремкомплект рулевой рейки ";	the_title(); echo "</h1>";}?>
			<?php 
the_post_thumbnail( 'thumbnail'  ); echo"<br/><a href='http://rti-baltika.ru/images/";the_title();echo ".jpg'  rel='external me lightbox'/>";			
	echo "<img src='http://rti-baltika.ru/images/"; the_title();echo".jpg' title='Сальник рулевой рейки ";the_title();echo "' width='300'/></a>";	
			 echo "<br/>";
			 $code=get_post_custom();
			// var_dump($code);
			$attributes = $product->get_attributes();

			// var_dump ($attributes); 
if ($r<>1){
$rr=$attributes['size']['value'];
$rr1=str_replace('*','/',$rr);
$rr2=str_replace('*','-',$rr);

			 echo "Размер: ".$attributes['size']['value']." (Или: ".$rr1.", ".$rr2." )";

echo "<br/>";
			 
			 		
 echo "Тип: ".$attributes['type']['value']."<br/>";
echo "Описание: ".$attributes['naznachenie']['value']."<br/>";
    echo "Применение: ".$attributes['primmenenie']['value']."<br/>";
}
else{
 echo "Марка авто: ".$attributes['marka']['value']."<br/>";
 echo "Год выпуска: ".$attributes['god']['value']."<br/>";

echo "Описание: ".$attributes['naznachenie']['value']."<br/>";
 if ($r<>1) {    echo "Состав: ";} else {echo "Примечание: ";} echo $attributes['primmenenie']['value']."<br/>";
}
  

if ($r<>1) { // echo "Аналог: ";echo $attributes['analog']['value']."<br/>";
} 


			// woocommerce_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>
</article>
		

				</div><!-- /#primary-->

				

				<div class = 'clearfix'></div>

				

			</div>

		

		</div>
	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
	//	do_action('woocommerce_after_main_content');
	?>

	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
	?>

<?php get_footer('shop'); ?>