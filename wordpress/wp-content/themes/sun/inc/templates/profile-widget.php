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
  <div class="text-center">
    <div class="image-container">
      <div class="profile-picture" style="background-image:url(<?php print $profile_picture; ?>);">
      </div>
    </div>
    <h1 class="sun-username"><?php print $fullname; ?></h1>
    <p class="sun-description"><?php echo $user_description; ?></p>
    <div class="social-icons">
      <?php if($twitter): ?>
      <a class="handler" target="_blank" href="https://twitter.com/<?php print $twitter; ?>"><span class="icons fa fa-twitter"></span></a>
      <?php endif; ?>
      <?php if($facebook): ?>
      <a class="handler" target="_blank" href="https://www.facebook.com/<?php print $facebook; ?>"><span class="icons fa fa-facebook"></span></a>
      <?php endif; ?>
      <?php if($gplus): ?>
      <a class="handler" target="_blank" href="https://plus.google.com/u/0/+<?php print $gplus; ?>"><span class="icons fa fa-google-plus"></span></a>
      <?php endif; ?>
    </div>
  </div>
