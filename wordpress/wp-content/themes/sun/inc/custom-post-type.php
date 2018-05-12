
<?php
//theme Support
$contact_form = get_option('contact_form');
if (!empty($contact_form)) {
  add_action('init', 'sun_contact_custom_post_type');
  add_filter( 'manage_message_posts_columns', 'sun_set_contact_form_columns');
  add_action('manage_message_posts_custom_column', 'sun_contact_custom_column', 10, 2);
  add_action('add_meta_boxes', 'sun_contact_add_meta_box');
  add_action('save_post', 'sun_save_email_data');
}

//custom contact post type
function sun_contact_custom_post_type(){
  $labels = array(
    'name'              => 'Messages',
    'singular_name'     => 'Message',
    'add_new_item'      => 'Add New Message',
    'all_items'         => 'All Messages',
    'view_item'         => 'View Message',
    'edit_item'         => 'Edit Message',
    'search_items'      => 'Search Messages',
    'add_new'           => 'Add Message',
    'new_item'          => 'New Message',
    'not_found'         => 'No message found',
    'not_found_in_trash'=> 'No message found in trash',
    'parent_item_colon' => 'Parent item'
  );
  $args = array(
    'labels'          => $labels,
    'show_ui'         => true,
    'show_in_menu'    => true,
    'has_archive'     => true,
    'rewrite'         => true,
    'capability_type' => 'post',
    'hierarchical'    => false,
    'menu_position'   => 3,
    'menu_icon'       => 'dashicons-email-alt',
    'supports'        => array('title', 'editor', 'author')
  );
  register_post_type('message', $args);
}
function sun_set_contact_form_columns( $columns ){
  $newColumns = array();
  $newColumns['title'] = 'Full Name';
  $newColumns['message'] = 'Message';
  $newColumns['email'] = 'Email';
  $newColumns['date'] = 'Date';
  return $newColumns;
}
function sun_contact_custom_column($column, $post_id){
  switch ($column) {
    case 'message':
      echo get_the_excerpt();
      break;

    case 'email':
    $value = get_post_meta($post_id, '_contact_email_value_key', true);
      echo '<a href="mailto:'.$value.'">'.$value.'</a>';
      break;
  }
}

//contact meta boxes
function sun_contact_add_meta_box(){
  add_meta_box('contact_email', 'Email', 'sun_contact_email_callback', 'message', 'side');
}
function sun_contact_email_callback( $post ){
  wp_nonce_field('sun_save_email_data', 'sun_contact_email_meta_box_nonce');
  $value = get_post_meta($post->ID, '_contact_email_value_key', true);
  echo '<label for="sun_contact_email_field" ></label>';
  echo '<input type="email" id="sun_contact_email_field" name="sun_contact_email_field" value="'.esc_attr($value).'" size="25"/>';
}
function sun_save_email_data($post_id){
if(!isset($_POST['sun_contact_email_meta_box_nonce'])){
return;
}
if(!wp_verify_nonce($_POST['sun_contact_email_meta_box_nonce'], 'sun_save_email_data')){
return;
}
if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
return;
}
if(!current_user_can('edit_post', $post_id)){
return;
}
if(!isset($_POST['sun_contact_email_field'])){
  return;
}
$my_data = sanitize_text_field($_POST['sun_contact_email_field']);
update_post_meta($post_id, '_contact_email_value_key', $my_data);
}
