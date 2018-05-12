<h1>Sidebar Options</h1>
<?php settings_errors(); ?>
<?php
$profile_picture = esc_attr(get_option('profile_picture'));
$first_name = esc_attr(get_option('first_name'));
$last_name = esc_attr(get_option('last_name'));
$fullname = $first_name. ' ' . $last_name;
$user_description = esc_attr(get_option('user_description'));
$gplus = esc_attr(get_option('gplus'));
$facebook = esc_attr(get_option('facebook'));
$twitter = esc_attr(get_option('twitter'));
 ?>
<div class="sun-sidebar-preview">
  <div class="sun-sidebar">
    <div class="image-container">
      <div class="profile-picture" style="background-image:url(<?php print $profile_picture; ?>);">
      </div>
    </div>
    <h1 class="sun-username"><?php print $fullname; ?></h1>
    <p class="sun-description"><?php echo $user_description; ?></p>
    <div class="social-icons">
      <?php if($twitter): ?>
      <a class="handler" href="<?php print $twitter; ?>"><span class="icons dashicons-before dashicons-twitter"></span></a>
      <?php endif; ?>
      <?php if($facebook): ?>
      <a class="handler" href="<?php print $facebook; ?>"><span class="icons dashicons-before dashicons-facebook-alt"></span></a>
      <?php endif; ?>
      <?php if($gplus): ?>
      <a class="handler" href="<?php print $gplus; ?>"><span class="icons dashicons-before dashicons-googleplus"></span></a>
      <?php endif; ?>
    </div>
  </div>
</div>
<form class="general-form" action="options.php" method="post">
  <?php settings_fields('sun-settings-group'); ?>
  <?php do_settings_sections('sun_theme_options'); ?>
  <?php submit_button('Save Changes', 'primary', 'btnSubmit'); ?>
</form>
