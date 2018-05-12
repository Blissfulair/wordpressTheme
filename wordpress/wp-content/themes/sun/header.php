<?php
/*
This is the template for the header
@package sun_blessed
*/
 ?>
 <!DOCTYPE html>
 <html <?php language_attributes(); ?>>
    <head>
      <title><?php bloginfo('name'); wp_title('|'); ?></title>
      <meta name="description" content="<?php bloginfo('description'); ?>">
      <meta charset="<?php bloginfo('charset'); ?>">
      <meta name="viewport" content="width=device-width" intial-scale="1">
      <link rel="profile" href="http://gmpg.org/xfn/11">
      <?php if(is_singular() && pings_open(get_queried_object())): ?>
      <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" >
    <?php endif; ?>
    <?php wp_head(); ?>
    </head>
<body id="sun-body" <?php body_class(); ?>>
  <div class="sun-front-sidebar sun-closed">
  <div class="sun-front-sidebar-inner"><!-- -->
    <div class="js-sun-toggle" id="closed">
      <span class="fa fa-close"></span>
        </div>
        <div class="sun-scroll">
        <?php  get_sidebar(); ?>
       </div>
     </div>
   </div>
   <div class="sidebar-overlay js-sun-toggle"></div>
 <div class="container-fluid">
   <div class="row">
         <header class="header-container background-image text-center" style="background-image:url(<?php header_image(); ?>);" >
            <div class="header-content table">
              <div class="js-sun-toggle sun-menu" id="open">
                  <span class="menu"><span class="fa fa-bars"></span><span>
               </div>
              <div class="table-cell">
                  <h1 class="site-title"><?php bloginfo('name'); ?></h1>
                  <h2 class="site-description"><?php bloginfo('description'); ?></h2>
                </div>
              </div>
           <div class="nav-container">
             <nav class="navbar  navbar-sun">
                <?php
                  $args = array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class' => 'nav navbar-nav',
                    'walker'      => new Sun_Walker_Nav_Header()
                  );
                  wp_nav_menu($args);
                 ?>
             </nav>
           </div>
         </header><!--.header-container-->
   </div><!--.row-->

 </div> <!--.contanier-->
