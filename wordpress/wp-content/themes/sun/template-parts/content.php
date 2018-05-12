<?php
/*
========================================
Standard post format
========================================
@package sun_blessed
*/
 ?>
 <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
   <header class="entry-header text-center">
     <?php the_title('<h1 class="entry-title"><a href="'.esc_url(get_the_permalink()).'" rel="bookmark">', '</a></h1>'); ?>
      <div class="entry-meta">
          <?php echo sun_posted_meta(); ?>
      </div>
   </header>
   <div class="entry-content">
     <?php if(sun_get_post_image()): ?>
       <a href="<?php esc_url(the_permalink());?>" class="featured-image-link">
          <div class="standard-featured background-image" style="background-image:url(<?php echo sun_get_post_image(); ?>);"></div><!--.standard-featured-->
       </a>
     <?php endif; ?>
       <div class="entry-excerpt text-justify">
         <?php the_excerpt(); ?>
       </div>
   </div><!--.entry-content-->
   <div class="button-container text-center">
      <a href="<?php esc_url(the_permalink()); ?>" class="btn btn-sun"><?php _e('Read More'); ?></a>
   </div>
   <footer class="entry-footer">
     <?php echo sun_posted_footer(); ?>
   </footer>
 </article>
