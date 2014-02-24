<div class="container row">
	<div class="row"> 
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	 
	<header class="entry-header">
		<?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && theme_categorized_blog() ) : ?>
		<p class="entry-meta">
			<span class="cat-links"><?php echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'theme' ) ); ?></span>
		</p>
		<?php
			endif;

			if ( is_singular() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;
		?>

		<p class="entry-meta">
			<?php
				if ( 'post' == get_post_type() )
					theme_posted_on();

				if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
			?>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'theme' ), __( '1 Comment', 'theme' ), __( '% Comments', 'theme' ) ); ?></span>
			<?php
				endif;

				edit_post_link( __( 'Edit', 'theme' ), '<span class="edit-link">', '</span>' );
			?>
		</p><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php
			the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'theme' ) );
			wp_link_pages( array(
				'before'      => '<p class="page-links"><span class="page-links-title">' . __( 'Pages:', 'theme' ) . '</span>',
				'after'       => '</p>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<?php the_tags( '<footer class="entry-meta"><p class="tag-links">', '', '</p></footer>' ); ?>
</article><!-- #post-#<?php the_ID(); ?> -->
	</div>
</div>
