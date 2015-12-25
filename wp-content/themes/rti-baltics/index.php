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
						
						<?php the_content(); ?>
						
					</article><!-- /article.main -->
					
					<?php endwhile; ?>
					
				</div><!-- /#primary-->
				
				<div class = 'clearfix'></div>
				
			</div>
		
		</div>
<?php get_footer(); ?>