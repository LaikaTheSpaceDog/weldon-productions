<?php

// -------------------------
// WordPress thumbnail sizes
// -------------------------

add_theme_support('post-thumbnails');

add_image_size('home-slider', 1800, 500, true); // Homepage banner slider


// ----------------------
// Include CSS & JS files
// ----------------------

function fanatic_scripts() {
	// get from local copy to improve the performance
	wp_deregister_script('jquery');
	wp_register_script('jquery', get_template_directory_uri().'/assets/vendor/jq/jq.js' , array() , '3.4.1', false);

	// Theme Styles
	wp_enqueue_style( 'main-style', get_template_directory_uri().'/assets/css/style.css?' . time() );

	// Theme Scripts
	wp_enqueue_script('blazy-scripts', get_template_directory_uri().'/assets/vendor/blazy/blazy.min.js', array('jquery') , '1.8.2', true);
	wp_enqueue_script('wow-scripts', get_template_directory_uri().'/assets/vendor/wow/wow.min.js', array('jquery') , '3.0.0', true);
	wp_enqueue_script('skrollr-scripts', get_template_directory_uri().'/assets/vendor/skrollr/skrollr.min.js', array('jquery') , '0.6', true);
	wp_enqueue_script( 'slick-scripts', get_template_directory_uri().'/assets/vendor/slick/slick.min.js', array( 'jquery' ), '1.0' , true );
	wp_enqueue_script( 'theme-scripts', get_template_directory_uri().'/assets/js/script.min.js?' . time(), array( 'jquery' ), '1.0' , false );

	// Load on single page for specific post_type
	if( is_single( 'your_post_type' ) ) {
		// Load script or CSS here
	}

	// Load on homepage
	if( is_front_page() ) {
		// Load script or CSS here
	}

	// Load on search results page
	if( is_search() ) {
		// Load script or CSS here
	}

	// Load on page with specific template
	if(is_page()){ //Check if we are viewing a page
		global $wp_query;

		//Check which template is assigned to current page we are looking at
		$template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );
		if($template_name == 'page-template.php'){
			// Load script or CSS here
		}
	}

}
add_action('wp_enqueue_scripts' , 'fanatic_scripts');

// ---------------------------------------------------
// Defer jQuery Parsing using the HTML5 defer property
// ---------------------------------------------------

if (!(is_admin() )) {
	function defer_parsing_of_js ( $url ) {
		if ( FALSE === strpos( $url, '.js' ) ) return $url;
		if ( strpos( $url, 'jquery-3.3.1.min.js' ) ) return $url;
		// return "$url' defer ";
		return "$url' defer onload='";
	}
	add_filter( 'clean_url', 'defer_parsing_of_js', 11, 1 );
}


// -----------------------------------
// Add custom styles to TinyMCE Editor
// -----------------------------------

if ( ! function_exists( '_filter_mce_theme_format_insert_button' ) ) :
	function _filter_mce_theme_format_insert_button( $buttons ) {
		array_unshift( $buttons, 'styleselect' );

		return $buttons;
	} //_filter_mce_theme_format_insert_button()
endif;
add_filter( 'mce_buttons_2', '_filter_mce_theme_format_insert_button' );

// Callback function to filter the MCE settings
function my_mce_before_init_insert_formats( $init_array ) {
	// Define the style_formats array
	$style_formats = array(
		// Each array child is a format with it's own settings
		array(
			'title'    => 'Button',
			'selector' => 'a',
			'classes'  => 'btn',
			'wrapper'  => false,
			'exact'    => true
		),
		array(
			'title'    => 'Button secondary',
			'selector' => 'a',
			'classes'  => 'btn btn__secondary',
			'wrapper'  => false,
			'exact'    => true
		)
	);
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );

	return $init_array;

}
// Attach callback to 'tiny_mce_before_init'
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats', 1 );



// --------------------------------------------
// Show images illustrating the flexible blocks
// --------------------------------------------

add_action('admin_enqueue_scripts', 'acf_flexible_content_thumbnail');
function acf_flexible_content_thumbnail()
{

	// REGISTER ADMIN.CSS
	wp_enqueue_style('css-theme-admin', get_template_directory_uri() . '/assets/css/admin.css', false, 1.0);

	// REGISTER ADMIN.JS
	wp_register_script('js-theme-admin', get_template_directory_uri() . '/assets/js/admin.js', array('jquery'), 1.0, true);
	wp_localize_script('js-theme-admin', 'theme_var',
		array(
			'upload' => get_template_directory_uri() . '/assets/img/flexible-blocks/',
		)
	);
	wp_enqueue_script('js-theme-admin');

}
