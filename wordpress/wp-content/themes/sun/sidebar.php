
<?php
if(!is_active_sidebar('sidebar')){
  return;
}
?>
<aside id="secondary" role="complementary" class="widget-area">
  <?php dynamic_sidebar('sidebar'); ?>
</aside>
