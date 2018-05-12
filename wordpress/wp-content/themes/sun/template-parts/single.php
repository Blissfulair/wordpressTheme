<?php
/*
========================================
Single post format
========================================
@package sun_blessed
*/
 ?>
 <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
   <header class="entry-header text-center">
     <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
      <div class="entry-meta">
          <?php echo sun_posted_meta(); ?>
      </div>
   </header>
   <div class="entry-content text-justify clearfix">
     <?php if(sun_get_post_image()): ?>

          <div class=" background-image" style="background-image:url(<?php echo sun_get_post_image(); ?>);"></div><!--.standard-featured-->
     <?php endif; ?>
      <?php the_content(); ?>
   </div><!--.entry-content-->
   <footer class="entry-footer">
     <?php echo sun_posted_footer(); ?>
   </footer>
 </article>
