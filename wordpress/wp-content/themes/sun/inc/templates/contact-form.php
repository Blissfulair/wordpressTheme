<form class="contact-form-class" action="#" method="post">
    <div class="form-group">
        <input type="text" id="name" name="name"  class="form-control" placeholder="Author">
        <small class="text-danger form-control-msg sun-name">Your name is required</small>
    </div>
    <div class="form-group">
        <input type="text" id="email" name="email" class="form-control"  placeholder="Email Address">
        <small class="text-danger form-control-msg sun-email">A valid email address is required</small>
    </div>
    <div class="form-group">
        <textarea name="message" id="message"  class="form-control" placeholder="Write a message"></textarea>
        <small class="text-danger form-control-msg sun-message">Message is required</small>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-success " id="btn" data-submit="<?php echo admin_url('admin-ajax.php')?>">Submit </button>&nbsp;<span class="fa fa-spinner form-control-msg"></span>
    </div>
    <small class="text-info form-control-msg sun-message-processed">Submission in progress, please wait...</small>
    <small class="alert alert-success form-control-msg sun-message-sent">Message successfully sent, thank you!</small>
    <small class="alert alert-danger form-control-msg sun-message-fail">There was a problem with the contact form, please try again later!</small>
</form>
