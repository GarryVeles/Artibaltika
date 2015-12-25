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
					
					
					
					<article class = 'main'> 
					
						<header>
							<h2>Ошибка</h2>
						</header>
						
						<p>404. страница не найдена. </p>
						
					</article><!-- /article.main -->
					
					
					
				</div><!-- /#primary-->
				
				<div class = 'clearfix'></div>
				
			</div>
		
		</div>
<?php get_footer(); ?>