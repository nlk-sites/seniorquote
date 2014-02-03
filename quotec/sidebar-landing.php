<?php
 
if ( ! is_active_sidebar( 'landing-1' ) ) {
	return;
}
?>
<div id="landing-sidebar" class="landing-sidebar widget-area">
	<?php dynamic_sidebar( 'landing-1' ); ?>
</div><!-- #landing-sidebar -->
