<?php
/*
========================================
comments
========================================
@package sun_blessed
*/
if( post_password_required()){
  return;
}
 ?>
 <div id="comments" class="comments-area">
   <?php
      if( have_comments()):

    ?>
    <h2 class="comment-title">
       <?php
         printf(
           esc_html( _nx('1 comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'sun_blessed')),
           number_format_i18n(get_comments_number()),
           '<span>'. get_the_title(). '</span>'
         );
        ?>
    </h2>
    <?php sun_comments_nav(); ?>
    <ol class="comment-list">
      <?php
      $args = array(
        'walker' => null,
        'max_depth' => '',
        'style' => 'ol',
        'callback' => null,
        'end-callback' =>null,
        'type'  => 'all',
        'reply_text' => 'Reply',
        'page' => '',
        'per_page' => '',
        'avatar_size' => 64,
        'reverse_top_level' => true,
        'reverse_children' => false,
        'format'    =>    'html5',
        'short_ping'    =>  false,
        'echo'          =>  true
      );
      wp_list_comments($args);
       ?>
    </ol>
    <?php sun_comments_nav(); ?>
    <?php
      if(!comments_open() && get_comments_number()):
    ?>
    <p class="no-comments"><?php esc_html_e('Comments are closed.', 'sun_blessed'); ?></p>
    <?php
      endif;
     ?>
  <?php endif; ?>
   <?php
   $fields = array(
     'author'   =>
     '<div class="comment-form-author form-group"><label for="author">'.__('Name', 'domainreference').'<span class="required">*</span></label> <input id="author" class="form-control" name="author" type="text" value="'.$commenter['comment_author'].'" aria-required="true" required="required"></div>',
     'email'   =>
     '<div class="comment-form-email form-group"><label for="email">'.__('Email', 'domainreference').'<span class="required">*</span></label> <input id="email" class="form-control" name="email" type="text" value="'.$commenter['comment_author_email'].'" aria-required="true" required="required"></div>',
     'url'   =>
     '<div class="comment-form-url form-group"><label for="url">'.__('Website', 'domainreference').'</label> <input id="url" class="form-control" name="url" type="text" value="'.$commenter['comment_author_url'].'"></div>'
   );
$args = array(
  'comment_field'         =>    '<div class="comment-form-comment form-group"><label for="comment">'._x('Comment', 'noun').'</label> <textarea id="comment" name="comment" class="form-control" rows="8" maxlength="65525" aria-required="true" required="required"></textarea></p>',
  'fields'                =>     apply_filters('comment_form_default_fields', $fields),
  'class_submit'          =>    'btn btn-secondary btn-success',
  'label_submit'          =>    __('Send')
);
   comment_form($args); ?>
 <div><!--comments-area-->
