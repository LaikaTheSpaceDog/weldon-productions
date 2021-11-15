<?php
//=================================================================
// ADMIN AREA IMPROVEMENTS
//=================================================================

/**
 * Menus locations
 */
if ( ! function_exists('fanatic_setup') ) {
	function fanatic_setup() {
		//Add Theme Support
		add_theme_support( 'html5' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		/* Theme Menus */
		register_nav_menus(
			array(
				'header' => __('Header', 'fanatic'),
				'footer' => __('Footer', 'fanatic'),
				'footer-policies' => __('Footer Policies', 'fanatic'),
			)
		);
	}
}
add_action( 'after_setup_theme', 'fanatic_setup' );

/**
 * Remove Posts from admin bar
 */
function post_remove ()
{
	remove_menu_page('edit.php');
}

add_action('admin_menu', 'post_remove');


//=================================================================
// ADMIN AREA IMPROVEMENTS
//=================================================================

/**
 * Register custom fields Global Options
 */
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> true
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'General Settings',
		'menu_title'	=> 'General',
		'parent_slug'	=> 'theme-general-settings',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Company Details',
		'menu_title'	=> 'Company Details',
		'parent_slug'	=> 'theme-general-settings',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Marketing Settings',
		'menu_title'	=> 'Marketing',
		'parent_slug'	=> 'theme-general-settings',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Archives Settings',
		'menu_title'	=> 'Archives',
		'parent_slug'	=> 'theme-general-settings',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Forms Settings',
		'menu_title'	=> 'Forms',
		'parent_slug'	=> 'theme-general-settings',
	));

}

/**
 * Remove order field from Page Attributes box
 */
add_action('admin_head', 'hide_order_attribution');
function hide_order_attribution() {
	echo '<style>
		   label[for="menu_order"],
		   input[name="menu_order"] {
			 display:none;
		   }
		  </style>';
}

/**
 * Remove append a Ninja Form from page sidebar
 */
add_action('add_meta_boxes', function() {
	remove_meta_box('nf_admin_metaboxes_appendaform', ['page', 'post'], 'side');
}, 99);


/**
 * Collapse all custom fields groups
 */
function ACF_flexible_content_collapse() {
	?>
	<style id="acf-flexible-content-collapse">.acf-flexible-content .acf-fields { display: none; }</style>
	<script type="text/javascript">
			jQuery(function($) {
				$('.acf-flexible-content .layout').addClass('-collapsed');
				$('#acf-flexible-content-collapse').detach();
			});
	</script>
	<?php
}

add_action('acf/input/admin_head', 'ACF_flexible_content_collapse');


/**
 * Collapse revisions block
 */
function enqueue_my_scripts($hook) {
	?>
	<script type="text/javascript">
			jQuery(function($) {
				$('#revisionsdiv').addClass('closed');
			});
	</script>
	<?php
}
add_action( 'admin_enqueue_scripts', 'enqueue_my_scripts' );


/**
 * Get Google Maps API Key from Theme settings and and define it for ACF Maps field
 */
function my_acf_google_map_api( $api ){

	$api['key'] = 'AIzaSyDoWg7hLJxk_83LHhFl6tWKZ7UKjxttz3M';
	return $api;

}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');


/**
 * Add featured image to post list view and custom styles
 */
function add_img_column($columns) {
	$columns = array_slice($columns, 0, 1, true) + array("img" => "Featured Image") + array_slice($columns, 1, count($columns) - 1, true);
	return $columns;
}

function manage_img_column($column_name, $post_id) {
	if( $column_name == 'img' ) {
		echo get_the_post_thumbnail($post_id, 'thumbnail');
	}
	return $column_name;
}

add_action('admin_head', 'my_column_width');

function my_column_width() {
	echo '<style type="text/css">';
	echo '.column-img { width: 100px; } .column-img img { width: 100%; height: auto; } .column-title .row-title { font-size: 18px !important; max-width: 500px !important; }';
	echo '</style>';
}


//=================================================================
// PERFORMANCE
//=================================================================

/**
 * Remove Query Strings from Static Resources
 */
function _remove_script_version( $src ){
	$parts = explode( '?', $src );
	return $parts[0];
}
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );


/**
 * Remove unnecessary header links
 */
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'adjacent_posts_rel_link', 10); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);


/**
 * Remove Wordpress Embed script
 */
function my_deregister_scripts()
{
	wp_deregister_script('wp-embed');
}

add_action('wp_footer', 'my_deregister_scripts');


/**
 * Add DNS prefetch for external resources
 */
function stb_dns_prefetch() {
	echo '<meta http-equiv="x-dns-prefetch-control" content="on">
	<link rel="dns-prefetch" href="//www.google-analytics.com" />
	<link rel="dns-prefetch" href="//www.googletagmaanger.com" />
	<link rel="dns-prefetch" href="//maps.googleapis.com" />';
}
add_action('wp_head', 'stb_dns_prefetch', 0);
