<div id="secondary"> 
	<?php if ( has_nav_menu( 'nav-1' ) ) : ?>
	<nav role="navigation" class="navigation site-navigation">
		<?php wp_nav_menu( array( 'theme_location' => 'nav-1' ) ); ?>
	</nav>
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div><!-- #primary-sidebar -->
	<?php endif; ?>
</div><!-- #secondary -->
