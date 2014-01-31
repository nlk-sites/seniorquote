<?php
 
if ( ! is_active_sidebar( 'sidebar-4' ) ) {
	return;
}
?>

<div id="hero">
	<div id="hero-sidebar" class="hero-sidebar widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-4' ); ?>
	</div><!-- #hero-sidebar -->
</div><!-- #hero -->
