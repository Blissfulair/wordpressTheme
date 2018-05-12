<?php
/*
###################
ADMIN PAGE
###################
*/
function sun_add_admin_page(){
  // Admin menu display
  $args = array(
    'page_title' => 'Sun Theme Options',
    'menu_name' => 'Sun',
    'capability' => 'manage_options',
    'menu_slug' => 'sun_theme_options',
    'callback_funtion' => 'sun_theme_create_page',
    'menu_icon' => 'dash-icons-portfolio',
    'menu_position' => 123
  );


//Generate sun admin page

  add_menu_page('Sun Theme Options', 'Sun', 'manage_options',
  'sun_theme_options','sun_sidebar_create_page', 'dashicons-portfolio', 1 );

  //Generate sun submenu pages
  add_submenu_page(
    'sun_theme_options',
     'Sun Sidebar Options',
     'Sidebar',
     'manage_options',
     'sun_theme_options',
     'sun_sidebar_create_page'
   );
   add_submenu_page(
     'sun_theme_options',
      'Sun Theme Options',
      'Theme Options',
      'manage_options',
      'sun_custom_theme_options',
      'sun_theme_create_page'
    );
    add_submenu_page(
      'sun_theme_options',
       'Sun Contact Form',
       'Contact Form',
       'manage_options',
       'sun_contact_form_options',
       'sun_contact_form_create_page'
     );

   add_submenu_page(
     'sun_theme_options',
      'Sun CSS Options',
      'Custom CSS',
      'manage_options',
      'sun_theme_custom_css',
      'sun_theme_custom_css_create_page'
    );

    //Activate custom settings
    add_action('admin_init', 'sun_custom_settings');
}

add_action('admin_menu', 'sun_add_admin_page');

//Custom setting function
function sun_custom_settings(){
  register_setting('sun-settings-group', 'profile_picture');
  register_setting('sun-settings-group', 'first_name');
  register_setting('sun-settings-group', 'last_name');
  register_setting('sun-settings-group', 'user_description');
  register_setting('sun-settings-group', 'twitter', 'twitter_sanitize_callback');
  register_setting('sun-settings-group', 'facebook');
  register_setting('sun-settings-group', 'gplus');

  //Section creation
  add_settings_section(
    'sun_sidebar_options',
   'Sidebar Options',
    'sun_sidebar_option',
     'sun_theme_options'
   );

   add_settings_field(
     'sidebar-profile-picture',
     'Profile Picture',
     'sun_sidebar_profile_picture',
     'sun_theme_options',
     'sun_sidebar_options'
   );
  add_settings_field(
    'sidebar-name',
    'Full Name',
    'sun_sidebar_name',
    'sun_theme_options',
    'sun_sidebar_options'
  );
  add_settings_field(
    'sidebar-description',
    'Description',
    'sun_sidebar_description',
    'sun_theme_options',
    'sun_sidebar_options'
  );
  add_settings_field(
    'sidebar-twitter',
    'Twitter',
    'sun_sidebar_twitter',
    'sun_theme_options',
    'sun_sidebar_options'
  );
  add_settings_field(
    'sidebar-facebook',
    'Facebook',
    'sun_sidebar_facebook',
    'sun_theme_options',
    'sun_sidebar_options'
  );
  add_settings_field(
    'sidebar-googlePlus',
    'Google Plus',
    'sun_sidebar_google_plus',
    'sun_theme_options',
    'sun_sidebar_options'
  );

  //THEME SUPPORT settings
  register_setting(
    'sun-theme-support-group',
    'post_formats'
  );
  register_setting(
    'sun-theme-support-group',
    'custom_header'
  );
  register_setting(
    'sun-theme-support-group',
    'custom_background'
  );
  add_settings_section(
    'sun-theme-support-options',
   'Theme Options',
   'sun_support',
   'sun_custom_theme_options'
   );
  add_settings_field(
    'post-formats',
    'Post Formats',
    'sun_post_formats',
    'sun_custom_theme_options',
    'sun-theme-support-options'
  );
  add_settings_field(
    'custom-header',
    'Custom Header',
    'sun_custom_header',
    'sun_custom_theme_options',
    'sun-theme-support-options'
  );
  add_settings_field(
    'custom-background',
    'Custom Background',
    'sun_custom_background',
    'sun_custom_theme_options',
    'sun-theme-support-options'
  );

  //Contact form Options
  register_setting('sun-contact-options', 'contact_form');

  add_settings_section(
    'sun-contact-section',
    'Contact Form',
    'contact_form_function',
    'sun_contact_form_options'
  );
  add_settings_field(
  'activate-form',
  'Activate Form',
  'sun_activate_contact',
  'sun_contact_form_options',
  'sun-contact-section'
  );
}
function sun_activate_contact(){
  $contact_form = get_option('contact_form');
  $checked = (@$contact_form == 1 ? 'checked' : '');
echo '<label><input type="checkbox" '.$checked.' id="contact_form" name="contact_form" value="1"></label>';

}
function contact_form_function(){
  echo 'Activate contact form';
}
function sun_custom_header(){
  $custom_header = get_option('custom_header');
  $checked = (@$custom_header == 1 ? 'checked' : '');
echo '<label><input type="checkbox" '.$checked.' id="custom_header" name="custom_header" value="1"></label>';

}
function sun_custom_background(){
  $custom_background = get_option('custom_background');
  $checked = (@$custom_background == 1 ? 'checked' : '');
echo '<label><input type="checkbox" '.$checked.' id="custom_background" name="custom_background" value="1"></label>';

}
function sun_post_formats(){
    $post_formats = get_option('post_formats');
  $formats = array(
    'aside',
    'gallery',
    'link',
    'image',
    'quote',
    'status',
    'video',
    'audio',
    'chat'
  );
  $output = '';
  foreach($formats as $format){
      $checked = (@$post_formats[$format] == 1 ? 'checked' : '');
    $output .= '<label><input type="checkbox" '.$checked.' id="'.$format.'" name="post_formats['.$format.']" value="1">' .$format.'</label><br>';
  }
  echo $output;
}

function sun_sidebar_profile_picture(){
  $profile_picture = esc_attr(get_option('profile_picture'));
  if (empty($profile_picture)) {
  echo '<input type="button" class="button button-secondary" value="Upload Profile Picture" id="upload-button"><input type="hidden" id="profile-picture" name="profile_picture" value="">';
  }else{
  echo '<input type="button" class="button button-secondary" value="Change Profile Picture" id="upload-button">
  <input type="button" class="button button-secondary" value="Remove" id="remove-button">
  <input type="hidden" id="profile-picture" name="profile_picture" value="'.$profile_picture.'" >';
  }
}
function sun_sidebar_google_plus(){
  $gplus = esc_attr(get_option('gplus'));
  echo '<input type="text" name="gplus" value="'.$gplus.'" >';
}

function sun_sidebar_facebook(){
  $facebook = esc_attr(get_option('facebook'));
  echo '<input type="text" name="facebook" value="'.$facebook.'" >';
}
function sun_sidebar_twitter(){
  $twitter = esc_attr(get_option('twitter'));
  echo '<input type="text" name="twitter" size="46" value="'.$twitter.'" >';
  echo '<p class="description" >Input your twitter handler without the @ character</p>';
}

function sun_sidebar_name(){
  $first_name = esc_attr(get_option('first_name'));
  $last_name = esc_attr(get_option('last_name'));
  echo '<input type="text" name="first_name" placeholder="First Name" value="'.$first_name.'" >';
  echo '<input type="text" name="last_name" placeholder="Last Name" value="'.$last_name.'" >';
}
function sun_sidebar_description(){
  $user_description = esc_attr(get_option('user_description'));
  echo '<input type="text" name="user_description" size="46" value="'.$user_description.'" >';
  echo '<p class="description" >write something smart</p>';
}

//SANITIZE FUNCTIONS
function twitter_sanitize_callback($input){
  $output = sanitize_text_field($input);
  $output = str_replace('@', '' , $output);
  return $output;
}
function sun_support(){
  echo 'Activate and Deactivate Theme Support Options';
}
function sun_sidebar_option(){
  echo 'Customize your sidebar options';
}
function sun_sidebar_create_page(){
require_once get_template_directory() . '/inc/templates/sun-admin.php';
}

function sun_theme_create_page(){
require_once get_template_directory(). '/inc/templates/sun-theme-support.php';
}
function sun_contact_form_create_page(){
  require_once get_template_directory(). '/inc/templates/sun-contact-form.php';
}
function sun_theme_custom_css_create_page(){

}
