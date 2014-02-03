<?php 

	// Start the Loop.

	while ( have_posts() ) : the_post();

	global $post;

?>

<header id="masthead" class="site-header" role="banner">

	

	<div class="efc-btm">

		<div class="efc-bdy">

			<div class="efc-bg">

				

				<div class="container row">

					<div class="row">

						<div class="col span_8">

							

							<?php printf('<a href="%s" rel="home"><img style="z-index: 2;" class="brand" src="%s" alt=""/></a>', esc_url( home_url( '/' ) ), get_stylesheet_directory_uri().'/images/brand.png'); ?>

							<?php 

								$c_type = get_post_meta($post->ID, 'c_type', true);

								

								if($c_type)

								switch($c_type){

									case'photo':

									$photo = get_post_meta($post->ID, 'photo', true);

									if($photo){

										printf('<img id="topimg" src="%s" width="640" alt=""/>', $photo);

										}else{

										printf('<img id="topimg" src="%s" width="640" alt=""/>', 'http://placehold.it/640x403&text=NO%20IMAGE%20SELECTED');

									}

									

									break;

									

									case'video':

									printf('<img class="back" width="640" style="position:absolute;z-index: 1;" src="%s" alt=""/>', get_stylesheet_directory_uri().'/images/obj-7.jpg');

									echo '<div style="width:100%;max-width:594px;margin:0 auto;padding: 70px 0 0;position: relative;z-index: 9;">';

									$video = get_post_meta($post->ID, 'video', true);

									if($video)

									echo do_shortcode(sprintf('[video src="%s" autoplay="y" ogv="http://www.seniorquote.com/quotea/wp-content/uploads/2013/12/SeniorQuote_1b_480p.ogv" mp4="http://www.seniorquote.com/quotea/wp-content/uploads/2013/12/SeniorQuote_1b_480p.mp4" webm="http://www.seniorquote.com/quotea/wp-content/uploads/2013/12/SeniorQuote_1b_480p.webm" width="594" height="333" ]',$video));

									else

									printf('<img id="videoplacehold" src="%s" width="640" alt=""/>', 'http://placehold.it/640x403&text=NO%20VIDEO%20SELECTED');

									echo '</div>';

									break;

									

									case'html':

									$html = get_post_meta($post->ID, 'html', true);

									if($html){

										}else{

										printf('<img id="videoplacehold" src="%s" width="640" alt=""/>', 'http://placehold.it/640x403&text=EMPTY%20CONTENT%20');

										

									}

									

									break;

									}

									

								?>

							</div>

							<div class="col span_4">	

								

								<?php get_sidebar( 'landing' ); ?>

								

								<?php printf('<img class="pointer" src="%s" alt=""/>', get_stylesheet_directory_uri().'/images/action-pointer-calltodayorfilloutourform.png'); ?>

							</div>

							

							

							<div class="clear"></div>

						</div>

					</div>	

					

				</div>

			</div>

		</div>	

		

		

	</header><!-- #masthead -->	

	

	<?php 	

		endwhile;

	?>

