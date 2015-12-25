<?php get_header(); ?>

	<div class="content-wrapper">
			<main class="content">
		
					<nav class = 'breadcrumbs'>

		

						<?php if(function_exists('bcn_display')) bcn_display() ?>

						

					</nav>

					

					<?php while(have_posts()): the_post();?>

					

					<article class = 'main'> 

						<?php the_content(); ?>

						

					</article><!-- /article.main -->

					

					<?php endwhile; ?>
			</main>
				

					<?php get_sidebar(); ?>

					

		</div>
	</div>
				


<?php get_footer(); ?>