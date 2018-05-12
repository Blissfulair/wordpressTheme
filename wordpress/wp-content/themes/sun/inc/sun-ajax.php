<?php
/*
========================================
AJAX FUNCTIONS
========================================
@package sun_blessed
*/
add_action('wp_ajax_nopriv_sun_load_more_post', 'sun_load_more_post');
add_action('wp_ajax_sun_load_more_post', 'sun_load_more_post');
function sun_load_more_post(){
   $page = $_POST['page'];
   $prev = $_POST['prev'];
   $archive = $_POST['archive'];
   $paged = $page + 1;
   if ($prev == 1 && $page != 1) {
     $paged = $page - 1;
   }
   $args = array(
     'post_type'     =>    'post',
     'post_status'        =>     'publish',
     'paged'         =>     $paged
   );
   if ($archive != '0') {
     $archVal = explode('/', $archive);
     $type = ($archVal[3] == 'category'? 'category_name' : $archVal[3]);
     $args[$type] = $archVal[4];
     $page_trail = '/'. $archVal[1]. '/'.$archVal[2]. '/'. $archVal[3]. '/' .$archVal[4].'/';
   }else{
     $page_trail = '/sun/wordpress/';
   }
   $query = new WP_Query($args);
   if($query->have_posts()):
    echo '<div class="page-limit" data-page="'.$page_trail.'page/'.$paged.'">';
     while( $query->have_posts()): $query->the_post();
       get_template_part('template-parts/content', get_post_format());
   endwhile;
    echo '</div>';
   endif;
   wp_reset_postdata();
  die();
}
function sun_check_paged($num = null){
  $output= '';
  if (is_paged()) {
    $output = 'page/'. get_query_var('paged');
  }
  if ($num == 1 ) {
    $paged = (get_query_var('paged') == 0 ? 1 : get_query_var('paged'));
    return $paged;
  }else {
    return $output;
  }
}

//contact form
add_action('wp_ajax_nopriv_sun_save_contact_form_callback', 'sun_save_contact_form_callback');
add_action('wp_ajax_sun_save_contact_form_callback', 'sun_save_contact_form_callback');
function sun_save_contact_form_callback(){
   $name = wp_strip_all_tags($_POST['name']);
   $email = wp_strip_all_tags($_POST['email']);
   $message = wp_strip_all_tags($_POST['message']);
   if(empty($email) || empty($name) || empty($message)){
     return;
   }elseif(!(strpos($email, '@') > 0) && !(strpos($email, '.') > 0)){ echo $postID = 0; return;}

        //   $args = array(
        //     'post_title'     =>    $name,
        //     'post_content'   =>    $message,
        //     'post_author'    =>    1,
        //     'post_type'      =>    'message',
        //     'post_status'    =>    'publish',
        //     'meta_input'     =>    array(
        //       '_contact_email_value_key'   => $email
        //     )
        //   );
        //  $postID = wp_insert_post($args);
        //  echo $postID;
   //echo $message.$name.$email;


  die();
}
