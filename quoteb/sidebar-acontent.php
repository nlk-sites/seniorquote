<?php
 
if ( ! is_active_sidebar( 'landing-2' ) ) {
	return;
}
?>
<div id="landing-content" class="widget-area">
	<?php dynamic_sidebar( 'landing-2' ); ?>
</div><!-- #landing-content -->
