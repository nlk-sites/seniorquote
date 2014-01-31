<?php
	/**
		* Template Name: Landing Page
	*/

get_template_part( 'header', 'landing' );

get_template_part( 'tpl', 'landing-head' ); 

?>

<div id="main" class="site-main">
	
	<div class="container row">
		
		<div class="row gutters">
			
			<div class="col span_8">	
				
				<?php
					// Start the Loop.
					while ( have_posts() ) : the_post();
					global $post;
					
					
					$c_type = get_post_meta($post->ID, 'c_type', true);
					$video = get_post_meta($post->ID, 'video', true);
					if($c_type != 'video')
					if($video)
					echo do_shortcode(sprintf('<div style="padding:0 0 20px;">[video src="%s" width="619" height="347" autoplay="y"]</div>',$video));
					
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
			</div>
			<div class="clear"></div>
		</div>
		<div class="row gutters">
			<?php get_sidebar( 'hero' ); ?>
			
			
			<div class="clear"></div>
		</div>
		<div class="row gutters">			
			<div class="col span_8">	
				<div class="entry-content">	
					<?php get_sidebar( 'acontent' ); ?>
				</div>
			</div>
			
			<div class="col span_4">	
 				<?php get_sidebar( 'content' ); ?>
			</div>
			
			
			
			<div class="clear"></div>
		</div>
		
	</div>
</div>
<div class="container row">
	
	<div class="row gutters">
		<?php get_sidebar( 'hero' ); ?>
		
		<div class="clear"></div>
	</div>
</div>


<!-- #main -->
<?php get_template_part( 'footer', 'landing' );;
