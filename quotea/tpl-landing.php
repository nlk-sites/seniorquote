<?php
	/**
		* Template Name: Landing Page
	*/
?>
 
<?php get_template_part( 'header', 'landing' ); ?>
<?php get_template_part( 'tpl', 'landing-head' ); ?>
<div class="container row">
	
	<div class="row gutters">
		<?php get_sidebar( 'hero' ); ?>
		
		<div class="clear"></div>
	</div>
</div>
<div id="main" class="site-main">
	
	<div class="container row">
		
		<div class="row gutters">
			
			<div class="col span_8">	
				
				<?php
					// Start the Loop.
					while ( have_posts() ) : the_post();
					
					get_template_part( 'tpl', 'content' );
					
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
					endwhile;
				?>
				
			</div>
			
			<div class="col span_4">	
 				<?php get_sidebar(); ?>
 				<?php get_sidebar( 'content' ); ?>
			</div>
			
			<div class="clear"></div>
			</div>
			</div>
		</div>
		
		<!-- #main -->
		<?php get_template_part( 'footer', 'landing' );;
				