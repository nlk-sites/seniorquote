<?php  
	
	/**
		* Register three Theme widget areas.
		*
		* @since WP 3.8
		*
		* @return void
	*/
	function theme_widgets_init() { 
		
		register_sidebar( array(
		'name'          => __( 'Landing Sidebar', 'theme' ),
		'id'            => 'landing-1',
		'description'   => __( 'Landing sidebar that appears on the left.', 'theme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		) );
		register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'theme' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Main sidebar that appears on the left.', 'theme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		) );
		register_sidebar( array(
		'name'          => __( 'Landing Content', 'theme' ),
		'id'            => 'landing-2',
		'description'   => __( 'Landing Content that appears on the left.', 'theme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		) );
		register_sidebar( array(
		'name'          => __( 'Content Sidebar', 'theme' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Additional sidebar that appears on the right.', 'theme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		) );
		register_sidebar( array(
		'name'          => __( 'Footer Widget Area', 'theme' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears in the footer section of the site.', 'theme' ),
		'before_widget' => '<div id="%1$s" class="widget col span_4 %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		) );
		register_sidebar( array(
		'name'          => __( 'Hero Widget Area', 'theme' ),
		'id'            => 'sidebar-4',
		'description'   => __( 'Appears in the content and sidebar section of the site.', 'theme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		) );
	}
	add_action( 'widgets_init', 'theme_widgets_init' );
	
	
	
	/**
		* Enqueue scripts and styles for the front end.
		*
		* @since WP 3.8
		*
		* @return void
	*/
	function theme_scripts() {
		
		if(is_page_template( 'tpl-landing.php' )){
			// Add Genericons font, used in the main stylesheet.
			wp_enqueue_style( 'responsive-12col', get_stylesheet_directory_uri() . '/css/responsive.gs.12col.css', array(), '3.0.0' );
			wp_enqueue_style( 'fonts', get_stylesheet_directory_uri() . '/css/fonts.css', array(), '1' );  
			
			// Load our main stylesheet.
			wp_enqueue_style( 'theme-style', get_stylesheet_uri(), array( 'fonts', 'responsive-12col' ) );
			// Load our main stylesheet.
			wp_enqueue_style( 'theme-skin', get_stylesheet_directory_uri().'/skin.css', array( 'theme-style' ) );
			
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
			wp_enqueue_script( 'theme-respond', get_stylesheet_directory_uri() . '/scripts/respond.min.js', array( 'jquery' ), '20140101' );
			wp_enqueue_script( 'theme-script', get_stylesheet_directory_uri() . '/scripts/functions.js', array( 'jquery' ), '20140101', true );
		}
		else{
			wp_enqueue_style( 'direct-style', get_stylesheet_directory_uri().'/direct.css', array( ) );
		}
	}
	add_action( 'wp_enqueue_scripts', 'theme_scripts' );
	
	function theme_setup() { 
		
		// Add RSS feed links to <head> for posts and comments.
		add_theme_support( 'automatic-feed-links' );
		
		// Enable support for Post Thumbnails, and declare two sizes.
		add_theme_support( 'post-thumbnails' );
		
		// This theme uses wp_nav_menu() in three locations.
		register_nav_menus( array(
		'nav-1'   => __( 'Menu', 'theme' ),
		) );
		
		/*
			* Switch default core markup for search form, comment form, and comments
			* to output valid HTML5.
		*/
		add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list',
		) );
		
		/*
			* Enable support for Post Formats.
			* See http://codex.wordpress.org/Post_Formats
		*/
		add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
		) );
		
		// This theme uses its own gallery styles.
		add_filter( 'use_default_gallery_style', '__return_false' );
		
		add_action('add_meta_boxes', 'landing_metabox');
		add_action('save_post',  'landing_metabox_save');
		
		
	}
	add_action( 'after_setup_theme', 'theme_setup' );
	
	
	function landing_metabox() {
		global $post;
		$_wp_page_template = get_post_meta( $post->ID, '_wp_page_template' , true ) ;
		
		if($_wp_page_template === 'tpl-landing.php') 
		add_meta_box( 'landing-page-details', __('Details'), 'landing_metabox_details', 'page', 'normal', 'high');
	}
	function landing_metabox_details($post) {
		wp_enqueue_media();
		
		$c_type = get_post_meta( $post->ID, 'c_type' , true ) ;
		$name = 'photo';
		$photo = get_post_meta( $post->ID, $name , true ) ;
		printf('<p><label><input type="radio" name="c_type" value="%1$s" %3$s /> Photo</label></p><p><input class="regular-text" type="text" name="%1$s" id="%1$s" value="%2$s" /> <input id="%1$s_button" type="button" class="button ibutton" value="Select" />' ,$name ,$photo, checked( $c_type, $name, false ) );	
		printf(' <label for="%1$s">%2$s</label></p>', $name , 'Photo' );
		$name = 'video';
		$video = get_post_meta( $post->ID, $name , true ) ;
		printf('<p><label><input type="radio" name="c_type" value="%1$s" %3$s /> Video</label></p><p><input class="regular-text" type="text" name="%1$s" id="%1$s" value="%2$s" /> <input id="%1$s_button" type="button" class="button ibutton" value="Select" />' ,$name ,$video, checked( $c_type, $name, false ) );	
		printf(' <label for="%1$s">%2$s</label></p>', $name , 'Video' );
		$name = 'html';
		$html = get_post_meta( $post->ID, $name , true ) ;
		printf('<p><label><input type="radio" name="c_type" value="%1$s" %3$s /> %2$s</label></p>' ,$name , 'Html' , checked( $c_type, $name, false ));	
		
		wp_editor($html, $name, array('teeny' => false, 'tinymce' => true, 'quicktags' => true, 'media_buttons' => true, 'textarea_rows' => 6));
		
		
	?>
	<script type="text/javascript">
		
		
		// Uploading files
		var file_frame;
		
		jQuery('.ibutton').live('click', function( event ){
			
			event.preventDefault();
			var button = jQuery(this);
			var this_id = button.attr('id').replace('_button', '');
			
			//console.log(button);
			
			// If the media frame already exists, reopen it.
			if ( file_frame ) {
				file_frame.id = this_id;
				file_frame.open();
				//console.log('checked');
				//console.log(file_frame);
				return;
			}
			
			// Create the media frame.
			file_frame = wp.media.frames.file_frame = wp.media({
				title: 'Photo',
				button: {
					text: 'Select',
				},
				id: this_id,
				library : { type : 'image' },
				multiple: false  // Set to true to allow multiple files to be selected
			});
			
			// When an image is selected, run a callback.
			file_frame.on( 'select', function() {
				// We set multiple to false so only get one image from the uploader
				attachment = file_frame.state().get('selection').first().toJSON();
				
				jQuery( 'input[name="' + file_frame.id +'"]' ).val(attachment.url);
				
				
				
				
				//jQuery("#image-out img").hide().attr('src',attachment.url).show();
				
				// Do something with attachment.id and/or attachment.url here
			});
			
			// Finally, open the modal
			file_frame.open();
			//console.log('init');
			//console.log(file_frame);
		}); 
		
	</script>
	
	<?php 
	}
	
	function landing_metabox_save($post_id) {
		
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return;
		
		if (!current_user_can('edit_page', $post_id))
		return;
		
		if (!wp_is_post_revision($post_id))
		switch ($_POST['post_type']) {
			
			case 'page':
			$fields = array();
			$fields[] = 'c_type';
			$fields[] = 'photo';
			$fields[] = 'video';
			$fields[] = 'html';
			#$fields[] = 'image';
			#$fields[] = 'title';
			#$fields[] = 'link';
			#$fields[] = 'label';
			
			foreach($fields as $name){
				
				if(isset($_POST[$name])){
					$field_data = $_POST[$name];
					add_post_meta($post_id, $name, $field_data, true) or update_post_meta($post_id, $name, $field_data);
				}
				
			}
			
			break;
		}
	} 