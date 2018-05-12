<?php
/*
###################
ADMIN PAGE
###################
*/

function sun_load_admin_scripts( $hook ){
  if($hook != 'toplevel_page_sun_theme_options'){
    return;
  }
    wp_register_style('sun_admin_css', get_template_directory_uri(). '/css/sun-admin.css',  array(), '1.0.0', 'all');
    wp_enqueue_style('sun_admin_css');
    wp_enqueue_media();
    wp_register_script('sun_admin_js', get_template_directory_uri(). '/js/sun-admin.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('sun_admin_js');
}
add_action('admin_enqueue_scripts', 'sun_load_admin_scripts');



/*
###################
FRONTEND ENQUEUE FUNCTIONS
###################
*/
function sun_load_scripts(){
  wp_enqueue_style('font-awesome', get_template_directory_uri(). '/css/font-awesome.min.css', array(), '4.7.0', 'all');
  wp_enqueue_style('bootstrap', get_template_directory_uri(). '/css/bootstrap.min.css', array(), '3.3.7', 'all');
  wp_enqueue_style('sun', get_template_directory_uri(). '/css/sun.css', array(), '1.0.0', 'all');

  wp_enqueue_script('bootstrap', get_template_directory_uri(). '/js/bootstrap.min.js', array('jquery'), '3.3.7', true);
  wp_enqueue_script('sun', get_template_directory_uri(). '/js/sun.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'sun_load_scripts');
