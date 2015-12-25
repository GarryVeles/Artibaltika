<form role="search" method="get" id="searchform" action="<?php print home_url(); ?>">
			<div>
				<input type="text" style="Width:131px;" value="<?php the_search_query(); ?>" name="s" id="s" placeholder="Поиск товаров">
				<input type="submit" id="searchsubmit" value="Поиск">
			</div>
		</form>