<?php
/**
 * Plugin Name:       A simple optimizer by SitebuilderOne
 * Plugin URI:        https://github.com/sitebuilderone/wp2020/
 * Description:       Removes unecessary items from WordPress to make leaner and faster. Generate press only
 * Version:           1.0.7
 * Author:            Anthony Lepki
 * License:           GNU General Public License v2
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.html
 * Domain Path:       /languages
 * Text Domain:       wp2020
 * GitHub Plugin URI: https://github.com/sitebuilderone/wp2020/
 */


// ******************** Clean up WordPress Header ********************** //

define( 'WP_POST_REVISIONS', 3 );
define('AUTOSAVE_INTERVAL', 240 );  // seconds (default is 60)
define('WP_POST_REVISIONS', false ); // disable post revisions
define('WP_POST_REVISIONS', 3); // alter number of post revisions kept.
define('DISALLOW_FILE_EDIT', true );

remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
remove_action('template_redirect', 'rest_output_link_header', 11, 0);
remove_action ('wp_head', 'rsd_link');
remove_action( 'wp_head', 'wlwmanifest_link');
remove_action( 'wp_head', 'wp_shortlink_wp_head');
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action('welcome_panel', 'wp_welcome_panel');


function sb1_remove_version() {
	return '';
}
add_filter('the_generator', 'sb1_remove_version');

function sb1_cleanup_query_string( $src ){ 
	$parts = explode( '?', $src ); 
	return $parts[0]; 
} 
add_filter( 'script_loader_src', 'sb1_cleanup_query_string', 15, 1 ); 
add_filter( 'style_loader_src', 'sb1_cleanup_query_string', 15, 1 );
// ******************** Clean up WordPress Header END ********************** //

// ***** Footer ***** //
function remove_footer_admin () { 
echo 'Managed by <a href="https://www.sitebuilderone.com/" target="_blank">SiteBuilerOne</a></p>';
}
add_filter('admin_footer_text', 'remove_footer_admin');

// ***** Dashboard ***** //
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');

function my_custom_dashboard_widgets() {
global $wp_meta_boxes;

wp_add_dashboard_widget('custom_help_widget', 'Website Support', 'custom_dashboard_help');
}
function custom_dashboard_help() {
echo '<p>Need help? Contact the SiteBuilderOne by <a href="mailto:yourusername@gmail.com">e-mail</a>. </p>';
}


function wpb_new_contactmethods( $contactmethods ) {
// Add Twitter
$contactmethods['twitter'] = 'Twitter';
//add Facebook
$contactmethods['facebook'] = 'Facebook';
 
return $contactmethods;
}
add_filter('user_contactmethods','wpb_new_contactmethods',10,1);
//https://www.wpbeginner.com/plugins/how-to-add-additional-user-profile-fields-in-wordpress-registration/



// DISABLE SEARCH
// https://www.wpbeginner.com/wp-tutorials/25-extremely-useful-tricks-for-the-wordpress-functions-file/

function fb_filter_query( $query, $error = true ) {

if ( is_search() ) {
$query->is_search = false;
$query->query_vars[s] = false;
$query->query[s] = false;

// to error
if ( $error == true )
$query->is_404 = true;
}
}

add_action( 'parse_query', 'fb_filter_query' );
add_filter( 'get_search_form', create_function( '$a', "return null;" ) );




?>
