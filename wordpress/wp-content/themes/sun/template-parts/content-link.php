<?php
/*
========================================
Link post format
========================================
@package sun_blessed
*/
 ?>
 <article id="post-<?php the_ID(); ?>" <?php post_class('sun-format-link'); ?>>
   <header class="entry-header text-center">
     <?php
     $link = sun_grab_url();
    // echo $link;
     the_title('<h1 class="entry-title"><a href="'.$link.'" target="_blank">', '<div class="link-icon"><span class="fa fa-link"></span></div></a></h1>'); ?>
   </header>
 </article>
