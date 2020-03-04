<?php
if (!defined('WPINC')) { die; }
/*
=================================
  [[[  Global Theme Functions ]]]
=================================
*/

// Init Master
function ex_subservience() {
  add_action('init', 'ex_butler'); // enema machine
  add_action('wp_enqueue_scripts', 'ex_scripts_and_styles', 999); // enqueue base scripts and styles
  add_action('wp_default_scripts', 'remove_jquery_migrate'); // remove jquery migrate
  ex_theme_support(); // launching theme options
}

// WP Communion & Repentance
add_action('after_setup_theme', 'ex_subservience');
