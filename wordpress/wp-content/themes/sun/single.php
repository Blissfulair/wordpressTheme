<?php
/*
========================================
SINGLE
========================================
@package sun_blessed
*/
 ?>
<?php get_header(); ?>
  <div class="content-area" id="primary">
    <main id="main" class="site-main" role="main">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-xs-8 col-sm-10 col-md-10 col-lg-8 col-xs-offset-2 col-lg-offset-2 col-md-offset-1 col-sm-offset-1">
                <?php
                  if(have_posts()):
                    while( have_posts()): the_post();
                    sun_save_post_views($post->ID);
                      get_template_part('template-parts/single', get_post_format());
                      echo sun_post_navigation();
                    // $output = '';
                    // $args = array(
                    //   'category__in' => wp_get_post_categories(get_the_ID()),
                    //   'posts_per_page'  => 4
                    // );
                    // $related_posts = get_posts($args);
                    // if ($related_posts) {
                    //   setup_postdata($post);
                    //   $output .= '<div class="row"><div class="col-xs-12">';
                    //   foreach ($related_posts as $post) {
                    //     $output .= '<div class="col-xs-3"><div class="related">';
                    //   $output .= the_title();
                    //   $output .= the_excerpt();
                    //   $output .= '</div></div>';
                    //   }
                    //   $output .= '</div></div>';
                    // }
                      // wp_reset_postdata();
                      // echo $output;
                      if(comments_open()):
                        comments_template();
                      endif;
                    endwhile;
                  endif;
                 ?>
       </div><!--.col-xs-12-->
       </div><!--.row-->
      </div><!--.container-->
    </main>
  </div>
<?php get_footer(); ?>
