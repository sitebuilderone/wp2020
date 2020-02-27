/**
 * Plugin Name:       A simple optimizer by SitebuilderOne
 * Plugin URI:        https://github.com/sitebuilderone/wp2020/
 * Description:       Removes unecessary items from WordPress to make leaner and faster. Generate press only
 * Version:           1.0.5
 * Author:            Anthony Lepki
 * License:           GNU General Public License v2
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.html
 * Domain Path:       /languages
 * Text Domain:       wp2020
 * GitHub Plugin URI: https://github.com/sitebuilderone/wp2020/
 */


// ******************** Crunchify Tips - Clean up WordPress Header START ********************** //
function crunchify_remove_version() {
	return '';
}
add_filter('the_generator', 'crunchify_remove_version');
 
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
remove_action('template_redirect', 'rest_output_link_header', 11, 0);
 
remove_action ('wp_head', 'rsd_link');
remove_action( 'wp_head', 'wlwmanifest_link');
remove_action( 'wp_head', 'wp_shortlink_wp_head');

function crunchify_cleanup_query_string( $src ){ 
	$parts = explode( '?', $src ); 
	return $parts[0]; 
} 
add_filter( 'script_loader_src', 'crunchify_cleanup_query_string', 15, 1 ); 
add_filter( 'style_loader_src', 'crunchify_cleanup_query_string', 15, 1 );
// ******************** Clean up WordPress Header END ********************** //

function remove_footer_admin () { 
echo 'Fueled by <a href="http://www.wordpress.org" target="_blank">WordPress</a> | WordPress Tutorials: <a href="https://www.wpbeginner.com" target="_blank">WPBeginner</a></p>';
}
 
add_filter('admin_footer_text', 'remove_footer_admin');


add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
 
function my_custom_dashboard_widgets() {
global $wp_meta_boxes;
 
wp_add_dashboard_widget('custom_help_widget', 'Theme Support', 'custom_dashboard_help');
}
function custom_dashboard_help() {
echo '<p>Welcome to Custom Blog Theme! Need help? Contact the developer <a href="mailto:yourusername@gmail.com">here</a>. For WordPress Tutorials visit: <a href="https://www.wpbeginner.com" target="_blank">WPBeginner</a></p>';
}


