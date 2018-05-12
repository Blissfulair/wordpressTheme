<?php
/*
========================================
ARCHIVE
========================================
@package sun_blessed
*/
 ?>
<?php get_header(); ?>
  <div class="content-area" id="primary">
    <main id="main" class="site-main" role="main">
     <header class="archive-header text-center">
       <?php the_archive_title('<h1 class="page-title">', '</h1>'); ?>
     </header>
      <?php if(is_paged()): ?>
        <div class="container text-center load-previous">
            <a class="btn-sun-load sun-load-more" data-archive="<?php echo $_SERVER['REQUEST_URI']; ?>" data-prev="1" data-page="<?php echo sun_check_paged(1);?>" data-url="<?php echo admin_url('admin-ajax.php');?>">
              <span class="fa fa-refresh"></span>
              <span class="text"><?php _e(" Load Previous"); ?></span>
           </a>
        </div><!--.container-->
      <?php endif; ?>
      <div class="container sun-post-container">
        <?php
          if(have_posts()):
          echo '<div class="page-limit" data-page="'.$_SERVER['REQUEST_URI'].'">';
            while( have_posts()): the_post();
              get_template_part('template-parts/content', get_post_format());
          endwhile;
          echo '</div>';
          endif;
         ?>
      </div><!--.container-->
      <div class="container text-center">
          <a class="btn-sun-load sun-load-more" data-archive="<?php echo $_SERVER['REQUEST_URI']; ?>" data-page="<?php echo sun_check_paged(1);?>" data-url="<?php echo admin_url('admin-ajax.php');?>">
            <span class="fa fa-refresh"></span>
            <span class="text"><?php _e(" Load More"); ?></span>
         </a>
      </div><!--.container-->
    </main>
  </div>
<?php get_footer(); ?>
