<?php
/*
========================================
Audio post format
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
     <?php the_content(); ?>
   </div><!--.entry-content-->
   <footer class="entry-footer">
     <?php echo sun_posted_footer(); ?>
   </footer>
 </article>
