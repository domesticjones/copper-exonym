<?php
if (!defined('WPINC')) { die; }
/*
=====================================
  [[[ Admin & Login Customization ]]]
=====================================
*/

// Admin footer attribution
function remove_footer_admin() {
  echo '<span id="footer-thankyou">Exstructae : <a href="http://domesticjones.com" target="_blank">Exonym</a></span>';
}
add_filter('admin_footer_text', 'remove_footer_admin');

// Kill the admin bar on the front-end
add_filter('show_admin_bar', '__return_false');

// Custom Login Logo
function custom_login_logo() { ?>
  <style type="text/css">
    #login h1 a,
    .login h1 a {
      background-image: url();
    }
  </style>
<?php }
add_action('login_enqueue_scripts', 'custom_login_logo');

// Enable SVG upload in admin
function wpcontent_svg_mime_type($mimes = array()) {
  $mimes['svg']  = 'image/svg+xml';
  $mimes['svgz'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'wpcontent_svg_mime_type');

// Allow Editors to edit Menus
$roleObject = get_role( 'editor' );
if (!$roleObject->has_cap('edit_theme_options')) {
  $roleObject->add_cap('edit_theme_options');
}

// ACF: Header/Footer options
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	    => __('Header'),
		'menu_title'	    => __('Header'),
		'menu_slug' 	    => 'header-settings',
    'position'        => 3,
		'capability'	    => 'edit_posts',
    'icon_url'        => 'dashicons-feedback',
    'update_button'   => __('Save Header Settings', 'acf'),
    'updated_message' => __('Global Header Updated', 'acf')
	));

	acf_add_options_page(array(
		'page_title' 	    => __('Footer'),
		'menu_title'	    => __('Footer'),
		'menu_slug' 	    => 'footer-settings',
    'position'        => 3,
		'capability'	    => 'edit_posts',
    'icon_url'        => 'dashicons-feedback',
    'update_button'   => __('Save Footer Settings', 'acf'),
    'updated_message' => __('Global Footer Updated', 'acf')
	));

}
