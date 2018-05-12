<?php
/*
========================================
Quote post format
========================================
@package sun_blessed
*/
 ?>
 <article id="post-<?php the_ID(); ?>" <?php post_class('sun-format-quote'); ?>>
   <header class="entry-header text-center">
     <div class="row">
       <div class="col-sm-10 col-md-8 col-sm-offset-1 col-md-offset-2">
         <h1 class="quote-content"><a href="<?php esc_url(the_permalink());?>"><?php echo get_the_content(); ?></a></h1>
         <?php the_title('<h2 class="quote-author">-', '-</h2>'); ?>
      </div><!--.col-md-8-->
    </div><!--.row-->
   </header>
   <footer class="entry-footer">
     <?php echo sun_posted_footer(); ?>
   </footer>
 </article>
