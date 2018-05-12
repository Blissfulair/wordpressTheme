<?php
/*
========================================
page
========================================
@package sun_blessed
*/
 ?>
 <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
   <header class="entry-header text-center">
     <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
   </header>
   <div class="entry-content text-justify">
      <?php the_content(); ?>
   </div><!--.entry-content-->
 </article>
