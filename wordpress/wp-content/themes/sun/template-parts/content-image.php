<?php
/*
========================================
Image post format
========================================
@package sun_blessed
*/
 ?>
 <article id="post-<?php the_ID(); ?>" <?php post_class('sun-format-image'); ?>>
  <?php if(sun_get_post_image() ):?>
          <header class="entry-header text-center background-image" style="background-image:url(<?php echo sun_get_post_image(); ?>);">
                  <?php the_title('<h1 class="entry-title"><a href="'.esc_url(get_the_permalink()).'" rel="bookmark">', '</a></h1>'); ?>
                      <div class="entry-meta">
                              <?php echo sun_posted_meta(); ?>
                      </div>
                <div class="entry-excerpt image-caption">
                    <?php the_excerpt(); ?>
                </div>
          </header>
   <footer class="entry-footer">
     <?php echo sun_posted_footer(); ?>
   </footer>
 <?php endif; ?>
 </article>
