<?php
if (!defined('WPINC')) { die; }
/*
========================================
  [[[  Remove Extraneous Theme Items ]]]
========================================
*/

// Master butler
function ex_butler() {
	remove_action('wp_head', 'feed_links_extra', 3); // category feeds
	remove_action('wp_head', 'feed_links', 2); // post and comment feeds
	remove_action('wp_head', 'rsd_link'); // remove RSD link
	remove_action('wp_head', 'wlwmanifest_link' ); // windows live writer
	remove_action('wp_head', 'parent_post_rel_link', 10, 0); // previous link
	remove_action('wp_head', 'start_post_rel_link', 10, 0); // start link
	remove_action('wp_head', 'index_rel_link'); // remove link to index page
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0); // links for adjacent posts
	remove_action('wp_head', 'print_emoji_detection_script', 7); // remove injected CSS for Emojis
	remove_action('wp_print_styles', 'print_emoji_styles'); // remove injected CSS for Emojis
  remove_action('wp_head', 'rest_output_link_wp_head', 10); // Remove the REST API lines from the HTML Header
  remove_action('wp_head', 'wp_oembed_add_discovery_links', 10); // Remove the REST API lines from the HTML Header
	add_filter('style_loader_src', 'remove_wp_ver_css_js', 9999); // remove WP version from css
	add_filter('script_loader_src', 'remove_wp_ver_css_js', 9999); // remove WP version from scripts
	add_filter('the_generator', 'ex_rss_version'); // remove version from RSS
	add_filter('wp_head', 'ex_remove_wp_widget_recent_comments_style', 1 ); // remove injected css for recent comments widget
	add_action('wp_head', 'ex_remove_recent_comments_style', 1); // clean up comment styles in the head
	add_filter('gallery_style', 'ex_gallery_style'); // clean up gallery output
  add_filter('the_content', 'ex_filter_ptags_on_images'); // cleaning up random code around images
	remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
}

// Strip out oEmbed stuff
function disable_embeds_code_init() {

 // Remove the REST API endpoint.
 remove_action( 'rest_api_init', 'wp_oembed_register_route' );

 // Turn off oEmbed auto discovery.
 add_filter( 'embed_oembed_discover', '__return_false' );

 // Don't filter oEmbed results.
 remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );

 // Remove oEmbed discovery links.
 remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

 // Remove oEmbed-specific JavaScript from the front-end and back-end.
 remove_action( 'wp_head', 'wp_oembed_add_host_js' );
 add_filter( 'tiny_mce_plugins', 'disable_embeds_tiny_mce_plugin' );

 // Remove all embeds rewrite rules.
 add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );

 // Remove filter of the oEmbed result before any HTTP requests are made.
 remove_filter( 'pre_oembed_result', 'wp_filter_pre_oembed_result', 10 );
}

add_action( 'init', 'disable_embeds_code_init', 9999 );

function disable_embeds_tiny_mce_plugin($plugins) {
    return array_diff($plugins, array('wpembed'));
}

function disable_embeds_rewrites($rules) {
    foreach($rules as $rule => $rewrite) {
        if(false !== strpos($rewrite, 'embed=true')) {
            unset($rules[$rule]);
        }
    }
    return $rules;
}

// Remove WP version from RSS
function ex_rss_version() { return ''; }

// Remove injected CSS for recent comments widget
function ex_remove_wp_widget_recent_comments_style() {
  if (has_filter('wp_head', 'wp_widget_recent_comments_style')) {
    remove_filter('wp_head', 'wp_widget_recent_comments_style');
  }
}

// Remove injected CSS from recent comments widget
function ex_remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action('wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
  }
}

// Remove injected CSS from gallery
function ex_gallery_style($css) {
  return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}

// Remove the <p> tag from around images
function ex_filter_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

// Limit post revisions to 5
if(!defined('WP_POST_REVISIONS')) define('WP_POST_REVISIONS',5);

// Remove unnecessary user data
function remove_default_userfields( $contactmethods ) {
  unset($contactmethods['aim']);
  unset($contactmethods['jabber']);
  unset($contactmethods['yim']);
  return $contactmethods;
}
add_filter('user_contactmethods','remove_default_userfields',10,1);

// Remove WP version from scripts
function remove_wp_ver_css_js($src) {
  if (strpos($src, 'ver=')){
    $src = remove_query_arg('ver', $src);
  }
  return $src;
}

// Remove comment count for pages
function remove_pages_count_columns($defaults) {
  unset($defaults['comments']);
  return $defaults;
}
add_filter('manage_pages_columns', 'remove_pages_count_columns');

// CF7: Remove extraneous wrappers
add_filter('wpcf7_autop_or_not', '__return_false');

// CF7: Only load stylesheets when necessary
function ex_cleanCf7() {
	global $post;
	$cf7DefaultCheck = has_shortcode($post->post_content, 'contact-form-7');
	if(!$cf7DefaultCheck) {
		wp_dequeue_script('contact-form-7'); // Dequeue JS Script file.
		wp_dequeue_style('contact-form-7');  // Dequeue CSS file.
	}
}
add_filter('wp_enqueue_scripts', 'ex_cleanCf7');
