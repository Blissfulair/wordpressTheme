<h1>Sun Theme Support Options</h1>
<?php settings_errors(); ?>
<?php
 ?>
<form class="general-form" action="options.php" method="post">
  <?php settings_fields('sun-theme-support-group'); ?>
  <?php do_settings_sections('sun_custom_theme_options'); ?>
  <?php submit_button(); ?>
</form>
