<?php
/*
========================================
Aside post format
========================================
@package sun_blessed
*/
 ?>
 <article id="post-<?php the_ID(); ?>" <?php post_class('sun-format-aside'); ?>>
   <div class="aside-container">
       <div class="row">
          <div class="col-xs-12 col-xs-3 col-sm-3 col-md-2 text-center">
            <?php if(sun_get_post_image()): ?>
                 <div class="aside-featured background-image" style="background-image:url(<?php echo sun_get_post_image(); ?>);"></div><!--.standard-featured-->
            <?php endif; ?>
          </div><!--.col-xs-12 col-sm-4 col-md-3 text-center-->
          <div class="col-xs-12 col-xs-9 col-sm-9 col-md-10">
            <header class="entry-header">
              <div class="entry-meta">
                   <?php echo sun_posted_meta(); ?>
               </div>
            </header>
            <div class="entry-content">

                <div class="entry-excerpt text-justify">
                  <?php the_content(); ?>
                </div>
            </div><!--.entry-content-->
          </div><!--.col-xs-12 col-sm-8 col-md-9-->
       </div><!--.row-->
       <footer class="entry-footer">
         <div class="row">
            <div class="col-xs-9 col-xs-offset-3 col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">
         <?php echo sun_posted_footer(); ?>
           </div><!--.col-xs-12 col-sm-8 col-md-9-->
        </div><!--.row-->
       </footer>
 </div><!-- .aside-container -->
 </article>
