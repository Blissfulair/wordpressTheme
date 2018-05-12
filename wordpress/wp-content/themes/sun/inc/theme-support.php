
<?php
//theme Support
$post_formats = get_option('post_formats');
if(!empty($post_formats)){
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
  $output = array();
  foreach($formats as $format){
      $output[] = (@$post_formats[$format] == 1 ? $format : '');
    }
  add_theme_support('post-formats', $output);
}

$custom_header = get_option('custom_header');
if (!empty($custom_header)) {
  add_theme_support('custom-header');
}
$custom_background = get_option('custom_background');
if (!empty($custom_background)) {
  add_theme_support('custom-background');
}
add_theme_support('post-thumbnails');
/*Activate the Nav menu options*/
function sun_register_nav_menu(){
  register_nav_menu('primary', 'Header Navigation Menu');
}
add_action('after_setup_theme', 'sun_register_nav_menu');
//Activate HTML5 features
add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));

//sidebar function
function sun_sidebar(){
  $args = array(
    'name'          =>  'Sidebar',
    'id'            =>  'sidebar',
    'class'         =>  'custom',
    'description'   =>  'Sun widget area',
    'before_widget' =>  '<aside id="%1$s" class=sun-widget "%2$s">',
    'after_widget'  =>  '</aside>',
    'before_title'  =>  '<h3 class="widget-title">',
    'after_title'   =>  '</h3>'
  );
  register_sidebar($args);
}
add_action('widgets_init', 'sun_sidebar');

/*
BLOG LOOP CUSTOM FUNCTIONS
*/
function sun_posted_meta(){
  $posted_on = human_time_diff(get_the_time('U'), current_time('timestamp'));
  $categories = get_the_category();
  $seperator = ', ';
  $output = '';
  $i = 1;
  if (!empty($categories)):
    foreach($categories as $category):
      if($i > 1): $output .= $seperator; endif;
      $output .= '<a href="'.get_term_link($category, 'category').'" alt="'.esc_attr('View all posts %1$s',
       $category->name).'">'.esc_html($category->name).'</a>';
    $i++;
  endforeach;
  endif;
  return  '<span class="posted-on">Posted <a href="'.esc_url(get_the_permalink()).'">'.$posted_on.'</a> ago </span> | <span class="posted-in">'.$output.'</span>';
}
function sun_posted_footer(){
  $comments_num = get_comments_number();
  if( comments_open()){
    if( $comments_num == 0){
      $comments = __('No Comments');
    }elseif( $comments_num > 1){
      $comments = $comments_num . __(' Comments');
    }else {
      $comments = __('1 Comment');
    }
    $comments = '<a class="comment-link" href="'.get_comments_link().'">'.$comments.'<span class="comment-icon" ><i class="fa fa-comment"></i></span></a>';
  }else{
    $comments = __('Comments are closed ');
  }
  return '<div class="post-footer-container"><div claas="row">
  <div class="col-xs-12 col-sm-6">'.get_the_tag_list('<div class="tags-list"><span class="tags-icon" ><i class="fa fa-tags"></i></span>', ' ', '</div>').'</div>
  <div class="col-xs-12 col-sm-6 text-right">'.$comments.'</div></div></div>';
}

function sun_get_post_image($num = 1){
  $output = '';
   if(has_post_thumbnail() && $num == 1):
     $featured_image = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
     $output = $featured_image;
   else:
     $attachments = get_posts( array(
       'post_type' => 'attachment',
       'posts_per_page' => $num,
       'post_parent' => get_the_ID()
     ));
     if( $attachments && $num == 1):
       foreach($attachments as $attachment):
         $output = wp_get_attachment_url( $attachment->ID);
       endforeach;
     elseif( $attachments && $num > 1):
       $output = $attachments;
     endif;
     wp_reset_postdata();
   endif;
    return $output;
}

function sun_get_carousel_data($attachments){
  $output = array();
  $count = count($attachments) - 1;
  for($i = 0; $i <= $count; $i++):
    $n = ($i == $count ? 0 : $i + 1);
    $nextImage = wp_get_attachment_thumb_url($attachments[$n]->ID);
    $p = ($i == 0? $count : $i - 1);
    $prevImage = wp_get_attachment_thumb_url($attachments[$p]->ID);
    $active = ($i == 0 ? 'active' : '');
    $output[$i] = array(
      'class'       =>  $active,
      'url'         =>  wp_get_attachment_url($attachments[$i]->ID),
      'next_img'    =>  $nextImage,
      'prev_img'    =>  $prevImage,
      'caption'     =>  $attachments[$i]->post_excerpt
    );
 endfor;
 return $output;

}

function sun_grab_url(){
  if(!preg_match('/<a\s[^>]*?href=[\'"](.+?)[\'"]/i', get_the_content(), $links)){
    return false;
  }
  return esc_url_raw($links[1]);
}
//Custom single post function
function sun_post_navigation(){
  $nav = '<div class="row">';
  $prev = get_previous_post_link('<div class="sun-post-nav">%link</div>', '<span class="fa fa-angle-left"></span>Prev');
  $nav .= '<div class="col-xs-12 col-sm-6">'.$prev.'</div>';
  $next = get_next_post_link('<div class="sun-post-nav">%link</div>', 'Next<span class="fa fa-angle-right"></span>');
  $nav .= '<div class="col-xs-12 col-sm-6 text-right">'.$next.'</div>';
  $nav .= '</div>';
  return $nav;
}
//Custom sun share function
function sun_share_social_media( $content ){
  if(is_single()):
     $output = '';
     $output .= '<div class="sun-share">';

     $title = get_the_title();
     $permalink = get_the_permalink();
     $twitterHandler = (get_option('twitter')? '&amp;via='.esc_attr(get_option('twitter')) : '');
     $twitter = 'https://twitter.com/intent/tweet?text='.$title.'&amp;url='.$permalink.''.$twitterHandler.'';
     $facebook = 'https://www.facebook.com/sharer/sharer.php?u='.$permalink.'';
     $google = 'https://plus.google.com/share?url='.$permalink;

     $output .= '<ul>';
     $output .= '<h4>Share This</h4>';
     $output .= '<li class="share" id="twitter"><a href="'.$twitter.'" rel="nofollow" target="_blank"><span class="fa fa-twitter"></span></a></li>';
     $output .= '<li class="share" id="facebook"><a href="'.$facebook.'" rel="nofollow" target="_blank"><span class="fa fa-facebook"></span></a></li>';
     $output .= '<li class="share" id="google"><a href="'.$google.'" rel="nofollow" target="_blank"><span class="fa fa-google-plus"></span></a></li>';
     $output .= '</ul>';
     $output .= '</div>';
   return $content.$output;
 else:
   return $content;
 endif;
}

add_filter('the_content', 'sun_share_social_media');

//Comments navication
function sun_comments_nav(){
  if(get_comment_pages_count() > 1 && get_option('page_comments')):
      require_once get_template_directory() . '/inc/templates/sun-comments-nav.php';
  endif;
}
function sun_profile_widget(){
  require_once get_template_directory(). '/inc/templates/profile-widget.php';
}

function related_post(){
  $output = '';
  $args = array(
    'category__in' => wp_get_post_categories(get_the_ID()),
    'posts_per_page'  => 4
  );
  $related_posts = get_posts($args);
  if ($related_posts) {
    setup_postdata($post);
    $output .= '<div class="row"><div class="col-xs-12">';
    foreach ($related_posts as $post) {
      $output .= '<div class="col-xs-3"><div class="related">';
    the_title();
    $output .= '</div></div>';
    }
    $output .= '</div></div>';
  }
  wp_reset_postdata();
  return $output;
}

function sun_contact(){
  require_once get_template_directory(). '/inc/templates/contact-form.php';
}
