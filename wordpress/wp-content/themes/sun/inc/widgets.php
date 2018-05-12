<?php
/*
@package sun_blessed
##################################################################
WIDGETS CLASS
##################################################################
*/
class Sun_Profile_Widget extends WP_Widget {

  public function __construct(){
      $widget_options = array(
        'classname'     => 'sun_profile_widget',
        'description'   =>  'Sun widget for profile picture and social media options'
      );
      parent::__construct('sun_profile', 'Sun Profile', $widget_options);
  }
  //backend display of widget
  public function form($instance){
    echo '<p><strong>No options for this widget here!</strong> <br> Click <em><a href="./admin.php?page=sun_theme_options">here</a></em> to access the admin customizer page.</p>';
  }
  //frontend display of widget
  public function widget($args, $instance){
    echo $args['before_widget'];
    sun_profile_widget();
    echo $args['after_widget'];
  }
}
add_action('widgets_init', function () {
  register_widget('Sun_Profile_Widget');
});


//Edit default wordpress widgets
function sun_tag_cloud_font_change($args){
  $args['smallest'] = 8;
  $args['largest'] = 8;
  return $args;
}
add_filter('widget_tag_cloud_args', 'sun_tag_cloud_font_change');
function sun_list_category_html_change($links){
  $links = str_replace('</a> (', '</a> <span>', $links);
  $links = str_replace(')', '</span>', $links);
  return $links;
}
add_filter('wp_list_categories', 'sun_list_category_html_change');

//save post views
function sun_save_post_views($postID){
  $metaKey = 'post_views';
  $views = get_post_meta($postID, $metaKey, true);
  $num_views = (empty($views)? 0 : $views);
  $num_views++;
  update_post_meta($postID, $metaKey, $num_views);
}
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

//Popular post widget
class Sun_Popular_Post_widget extends WP_Widget {
  public function __construct(){
    $widget_options = array(
      'classname'   =>    'sun_popular_post',
      'description' =>    'The most viewed posts'
    );
    parent::__construct('sun_popular_post_id', 'Most viewed posts', $widget_options);
  }
  //backend
  public function form($instance){
    $title = (!empty($instance['title'])? $instance['title'] : '');
    $tot = (!empty($instance['tot'])? absint($instance['tot']) : 0);
    $output = '<p>';
    $output .= '<label for="'.esc_attr($this->get_field_id('title')).'">Title: </label>';
    $output .= '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('title')).'" name="'.esc_attr($this->get_field_name('title')).'" value="'.esc_attr($title).'"><br>';
    $output .= '<label for="'.esc_attr($this->get_field_id('tot')).'">Number of posts: </label>';
    $output .= '<input type="number" step="1" class="tiny-text" id="'.esc_attr($this->get_field_id('tot')).'" name="'.esc_attr($this->get_field_name('tot')).'" value="'.esc_attr($tot).'">';
    $output .= '</p>';
    echo $output;
  }
  //Update widgets
  public function update($new_instance, $old_instance){
    $instance = array();
    $instance['title'] = (!empty($new_instance['title'])? strip_tags($new_instance['title']) : '');
    $instance['tot'] = (!empty($new_instance['tot'])? absint(strip_tags($new_instance['tot'])) : 0);
    return $instance;
  }
  //frontend
  public function widget($args, $instance){
    $tot = absint($instance['tot']);
    $post_args = array(
      'post_type'     => 'post',
      'posts_per_page'    => $tot,
      'meta_key'          => 'post_views',
      'orderby'           =>  'meta_value_num',
      'order'             => 'DESC'
    );
    $query = new WP_Query($post_args);
    echo $args['before_widget'];
      if(!empty($instance['title'])):
        echo $args['before_title'].apply_filters('widget_title', $instance['title']).$args['after_title'];
      endif;
      if($query->have_posts()):
        //echo '<ul class="most-popular">';
          while($query->have_posts()): $query->the_post();
          //section to get the number of views
          $metaKey = 'post_views';
          $views = get_post_meta(get_the_ID(), $metaKey, true);
          $views = (empty($views)? 0 : $views);
          ++$views;
          ($views > 1) ? $word = ' views' : $word = ' view';
   //Section for the comments
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

          echo '<div class="media">';
          echo '<div class="media-left"><img class="media-object" width="40px" height="40px" src="'.get_template_directory_uri().'/img/post-'.(get_post_format()? get_post_format() : 'standard' ).'.png"/></div>';
          echo '<div class="media-body"><a href="'.get_the_permalink().'">'.get_the_title().'<br><span class="views">'.$views.$word.'</span></a></div><span>'.$comments.'</span>';
          echo '</div>';
        endwhile;
        //echo '</ul>';

      endif;
    echo $args['after_widget'];
  }
}
add_action('widgets_init', function () {
  register_widget('Sun_Popular_Post_widget');
});
