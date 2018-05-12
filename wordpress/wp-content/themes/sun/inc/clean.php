<?php
/*
Remove generator version number
@package sun_blessed
*/
function sun_remove_wp_version_strings( $src ){
  global $wp_version;
  parse_str(parse_url($src, PHP_URL_QUERY), $query);
  if( !empty( $query['ver'] ) && $query['ver'] === $wp_version ){
    $src = remove_query_arg( 'ver', $src );
  }
  return $src;
}
function remove_generator(){
  return '';
}
add_filter('the_generator', 'remove_generator');
add_filter('script_loader_src', 'sun_remove_wp_version_strings');
add_filter('style_loader_src', 'sun_remove_wp_version_strings');
