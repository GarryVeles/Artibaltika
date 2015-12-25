</div><!-- /#footer -->

	
<footer class="footer">
		<div class="footer__wrap">
			<div class="footer__copy">2015 Все права защищены</div>
		</div>
	</footer>	
<?php wp_footer(); ?>

<script type="text/javascript">
$("#shopping_cart-2").stick_in_parent({container: $(".left-sidebar"),recalc_every: 1, offset_top: 0});

var $table = $('table.t1');
$table.floatThead({position: 'fixed'});
$table.floatThead({headerCellSelector: 1});
$table.floatThead('reflow');



</script>

<script type='text/javascript'> 
  height = $('.content').height(); 
 $('.left-sidebar').height(height );
  
</script>
</body>

</html>