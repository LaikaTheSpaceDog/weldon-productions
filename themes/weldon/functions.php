<?php

// -------------------------
// WordPress thumbnail sizes
// -------------------------

add_theme_support('post-thumbnails');

add_image_size('home-slider', 1800, 500, true); // Homepage banner slider


// ----------------------
// Include CSS & JS files
// ----------------------

function weldon_scripts() {
	// get from local copy to improve the performance
	wp_deregister_script('jquery');
	wp_register_script('jquery', get_template_directory_uri().'/assets/vendor/jq/jq.js' , array() , '3.4.1', false);

	// Theme Styles
	wp_enqueue_style( 'main-style', get_template_directory_uri().'/assets/css/style.css?' . time() );

	// Theme Scripts
	wp_enqueue_script('blazy-scripts', get_template_directory_uri().'/assets/vendor/blazy/blazy.min.js', array('jquery') , '1.8.2', true);
	wp_enqueue_script( 'slick-scripts', get_template_directory_uri().'/assets/vendor/slick/slick.min.js', array( 'jquery' ), '1.0' , true );
	wp_enqueue_script( 'jquery-easing-scripts', get_template_directory_uri().'/assets/vendor/jq/jquery.easing-1.3.pack.js', array( 'jquery' ), '1.0' , false );
	wp_enqueue_script( 'theme-scripts', get_template_directory_uri().'/assets/js/script.min.js?' . time(), array( 'jquery' ), '1.0' , false );
}

add_action('wp_enqueue_scripts' , 'weldon_scripts');

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

function register_jobs_post_type() {
	$labels = array(
	  'name'                  => _x( 'Jobs', 'Post Type General Name', 'text_domain' ),
	  'singular_name'         => _x( 'Job', 'Post Type Singular Name', 'text_domain' ),
	  'menu_name'             => __( 'Jobs', 'text_domain' ),
	  'name_admin_bar'        => __( 'Jobs', 'text_domain' ),
	  'archives'              => __( 'Job Archives', 'text_domain' ),
	  'attributes'            => __( 'Job Attributes', 'text_domain' ),
	  'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
	  'all_items'             => __( 'All Jobs', 'text_domain' ),
	  'add_new_item'          => __( 'Add New Job', 'text_domain' ),
	  'add_new'               => __( 'Add Job', 'text_domain' ),
	  'new_item'              => __( 'New Job', 'text_domain' ),
	  'edit_item'             => __( 'Edit Job', 'text_domain' ),
	  'update_item'           => __( 'Update Job', 'text_domain' ),
	  'view_item'             => __( 'View Job', 'text_domain' ),
	  'view_items'            => __( 'View Jobs', 'text_domain' ),
	  'search_items'          => __( 'Search Job', 'text_domain' ),
	  'not_found'             => __( 'Not found', 'text_domain' ),
	  'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
	  'featured_image'        => __( 'Featured Image', 'text_domain' ),
	  'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
	  'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
	  'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
	  'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
	  'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
	  'items_list'            => __( 'Items list', 'text_domain' ),
	  'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
	  'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
	  'label'                 => __( 'Job', 'text_domain' ),
	  'description'           => __( 'A Job', 'text_domain' ),
	  'labels'                => $labels,
	  'supports'              => array( 'title', 'custom-fields', 'revisions', 'author', 'thumbnail' ),
	  'taxonomies'            => array( 'post_tag'),
	  'hierarchical'          => false,
	  'public'                => true,
	  'show_ui'               => true,
	  'show_in_menu'          => true,
	  'menu_position'         => 5,
	  'show_in_admin_bar'     => true,
	  'show_in_nav_menus'     => true,
	  'can_export'            => true,
	  'has_archive'           => true,
	  'exclude_from_search'   => false,
	  'publicly_queryable'    => true,
	  'capability_type'       => 'page',
		'rewrite'               => array('slug' => 'jobs'),
	);
	register_post_type( 'jobs', $args );
}
add_action( 'init', 'register_jobs_post_type', 0 );