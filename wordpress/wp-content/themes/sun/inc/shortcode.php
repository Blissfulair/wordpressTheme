<?php
/*
@package sun_blessed
##################################################################
SHORTCODES
##################################################################
*/
add_shortcode('tooltip', 'sun_tooltip');
function sun_tooltip($atts, $content = null){
  //get the attributes
  $atts = shortcode_atts(
    array(
    'placement'   => 'top',
    'title'       => ''
  ),
  $atts,
  'tooltip'
);
$atts['title'] = ($atts['title'] == ''? $content: $atts['title'] );
return '<span class="sun-tooltip" data-toggle="tooltip" data-placement="'.$atts['placement'].'" title="'.$atts['title'].'">'.$content.'</span>';
}

add_shortcode('popover', 'sun_popover');
function sun_popover($atts, $content = null){
  //get the attributes
  $atts = shortcode_atts(
    array(
    'placement'   => 'top',
    'title'       => '',
    'trigger'     => 'click',
    'content'     => ''
  ),
  $atts,
  'popover'
);
$atts['content'] = ($atts['content'] == ''? $content: $atts['content'] );
$atts['title'] = ($atts['title'] == ''? 'Popover': $atts['content'] );
return '<span class="sun-tooltip" data-trigger="'. $atts['trigger'].'" data-content="'. $atts['content'].'" data-toggle="popover" data-placement="'.$atts['placement'].'" title="'.$atts['title'].'">'.$content.'</span>';
}
add_shortcode('contact_form', 'sun_contact_form');
function sun_contact_form($atts, $content = null){
  $atts = shortcode_atts(
    array(),
    $atts,
    'contact_form'
  );
   ob_start();
   sun_contact();
   return ob_get_clean();
}
