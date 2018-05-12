<?php
/*
========================================
INDEX
========================================
@package sun_blessed
*/
 ?>
<?php get_header(); ?>
  <div class="content-area" id="primary">
    <main id="main" class="site-main" role="main">
      <div class="container">
        <?php
          if(have_posts()):
            while( have_posts()): the_post();
              get_template_part('template-parts/content', 'page');
          endwhile;
          endif;
         ?>

    </main>
  </div>
<?php get_footer(); ?>
