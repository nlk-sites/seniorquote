<?php  
	
add_action( 'after_setup_theme', 'sq_setup' );
if ( ! function_exists( 'sq_setup' ) ):
	function sq_setup() {
			add_shortcode( 'num', 'sq_num_replace' );
			add_filter('widget_text', 'do_shortcode');
	}
endif;


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
		wp_enqueue_script( 'jquery-cookie', get_stylesheet_directory_uri() . '/scripts/jquery.cookie.js', array( 'jquery' ), '1.4', false);
		wp_enqueue_script( 'theme-respond', get_stylesheet_directory_uri() . '/scripts/respond.min.js', array( 'jquery' ), '20140101' );
		wp_enqueue_script( 'theme-script', get_stylesheet_directory_uri() . '/scripts/functions.js', array( 'jquery' ), '20140101', true );
		wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . '/scripts/custom.js', array( 'jquery' ), '1.0', false );
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

function tracking_code_header() {
	// google analytics all pages
	?>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-43204050-1', 'seniorquote.com');
	  ga('send', 'pageview');

	</script>
	<?php
}
add_action('wp_head', 'tracking_code_header');



function do_submit_the_form() {
	if ( isset($_POST['contactInfo']['email']) ) {
		$leadId = time();
		$firstName = $_POST['contactInfo']['firstName'];
		$lastName = $_POST['contactInfo']['lastName'];
		$state = $_POST['contactInfo']['state'];
		$zipCode = $_POST['contactInfo']['zipCode'];
		$dayPhone = $_POST['contactInfo']['dayPhone'];
		$email = $_POST['contactInfo']['email'];

		$m = $_POST['birthDate']['m'];
		$d = $_POST['birthDate']['d'];
		$y = $_POST['birthDate']['y'];

		$t = strtotime($m.'/'.$d.'/'.$y);
		$birthDate = date('Y-m-d',$t);

		$xmlstr = '<?xml version="1.0"?><Parallel6Lead>';
		$xmlstr .= "<leadInfo><leadId>" . $leadId . "</leadId></leadInfo>";
		$xmlstr .= "<contactInfo><firstName>" . $firstName . "</firstName>";
		$xmlstr .= "<lastName>" . $lastName . "</lastName>";
		$xmlstr .= "<state>" . $state . "</state>";
		$xmlstr .= "<zipCode>" . $zipCode . "</zipCode>";
		$xmlstr .= "<Phone>" . $dayPhone . "</Phone>";
		$xmlstr .= "<email>" . $email . "</email></contactInfo>";
		$xmlstr .= "<recipient><birthDate>" . $birthDate . "</birthDate></recipient>";
		$xmlstr .= "</Parallel6Lead>";

		$url = 'https://abcbenefits.insidesales.com/do=noauth/add_lead/70';

		$ch = curl_init($url);
		//curl_setopt($ch, CURLOPT_MUTE, 1);
		//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlstr);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$apiResult = curl_exec($ch);
		$httpResult = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		$a = array( 0 => $httpResult, 1 => $apiResult );
		return $a;
	}
	return false;
}


function sq_phonenumber( $format = true, $includetxt = false ) {
	$phone = '1.800.992.7724';
	
	if( isset( $_SESSION['sqphone'] ) ) {
		$phone = $_SESSION['sqphone'];
	}
	
	// check if ?s_cid=# is set in the URL, and switch accordingly
	if ( isset( $_GET['s_cid'] ) ) {
		$cid = $_GET['s_cid'];
		$cid = absint($cid);
		
		switch ( $cid ) {
			case 1:
				$phone = '1.800.992.7724';
				break;
		}
		
		$_SESSION['sqphone'] = $phone;
	}
	return $phone;
}

function sq_num_replace() {
	return sq_phonenumber(false);
}

// returns formatted phone number
function format_phone_us( $phone = '', $format='standard', $convert = true, $trim = true )
{
	if ( empty( $phone ) ) {
		return false;
	}
	// Strip out non alphanumeric
	$phone = preg_replace( "/[^0-9A-Za-z]/", "", $phone );
	// Keep original phone in case of problems later on but without special characters
	$originalPhone = $phone;
	// If we have a number longer than 11 digits cut the string down to only 11
	// This is also only ran if we want to limit only to 11 characters
	if ( $trim == true && strlen( $phone ) > 11 ) {
		$phone = substr( $phone, 0, 11 );
	}
	// letters to their number equivalent
	if ( $convert == true && !is_numeric( $phone ) ) {
		$replace = array(
			'2'=>array('a','b','c'),
			'3'=>array('d','e','f'),
			'4'=>array('g','h','i'),
			'5'=>array('j','k','l'),
			'6'=>array('m','n','o'),
			'7'=>array('p','q','r','s'),
			'8'=>array('t','u','v'),
			'9'=>array('w','x','y','z'),
			);
		foreach ( $replace as $digit => $letters ) {
			$phone = str_ireplace( $letters, $digit, $phone );
		}
	}
	$a = $b = $c = $d = null;
	switch ( $format ) {
		case 'standard':
			$a = '(';
			$b = ') ';
			$c = '-';
			$d = '(';
			break;
		case 'decimal':
			$a = '';
			$b = '.';
			$c = '.';
			$d = '.';
			break;
		case 'period':
			$a = '';
			$b = '.';
			$c = '.';
			$d = '.';
			break;
		case 'hypen':
			$a = '';
			$b = '-';
			$c = '-';
			$d = '-';
			break;
		case 'dash':
			$a = '';
			$b = '-';
			$c = '-';
			$d = '-';
			break;
		case 'space':
			$a = '';
			$b = ' ';
			$c = ' ';
			$d = ' ';
			break;
		default:
			$a = '(';
			$b = ') ';
			$c = '-';
			$d = '(';
			break;
	}
	$length = strlen( $phone );
	// Perform phone number formatting here
	switch ( $length ) {
		case 7:
			// Format: xxx-xxxx / xxx.xxxx / xxx-xxxx / xxx xxxx
			return preg_replace( "/([0-9a-zA-Z]{3})([0-9a-zA-Z]{4})/", "$1$c$2", $phone );
		case 10:
			// Format: (xxx) xxx-xxxx / xxx.xxx.xxxx / xxx-xxx-xxxx / xxx xxx xxxx
			return preg_replace( "/([0-9a-zA-Z]{3})([0-9a-zA-Z]{3})([0-9a-zA-Z]{4})/", "$a$1$b$2$c$3", $phone );
		case 11:
			// Format: x(xxx) xxx-xxxx / x.xxx.xxx.xxxx / x-xxx-xxx-xxxx / x xxx xxx xxxx
			return preg_replace( "/([0-9a-zA-Z]{1})([0-9a-zA-Z]{3})([0-9a-zA-Z]{3})([0-9a-zA-Z]{4})/", "$1$d$2$b$3$c$4", $phone );
		default:
			// Return original phone if not 7, 10 or 11 digits long
			return $originalPhone;
	}
}