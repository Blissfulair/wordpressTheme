<h1>Contact Form Options</h1>
<?php settings_errors(); ?>
<p>Use this <em>shortcode</em> to activate the Contact form inside a page or post</p>
<strong>[contact_form]</strong>
<form class="general-form" action="options.php" method="post">
  <?php settings_fields('sun-contact-options'); ?>
  <?php do_settings_sections('sun_contact_form_options'); ?>
  <?php submit_button(); ?>
</form>
