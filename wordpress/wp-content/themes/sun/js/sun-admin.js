jQuery(document).ready(function ($) {
  var mediaUploader;
  $('#upload-button').click(function (e) {
    e.preventDefault();
    if (mediaUploader) {
      mediaUploader.open();
      return;
    }
    mediaUploader = wp.media.frames.file_frame = wp.media({
      title: 'Choose a Profile Picture',
      button: {
        text: 'Choose Picture'
      },
      multiple : false,
    });
    mediaUploader.on('select', function () {
      attachment = mediaUploader.state().get('selection').first().toJSON();
      $('#profile-picture').val(attachment.url);
      $('.profile-picture').css({'background-image':'url(' + attachment.url +')'});
    });
    mediaUploader.open();
  });
  $('#remove-button').click(function (e) {
      e.preventDefault();
      var answer = confirm('Are your sure you to remove the picture?');
      if(answer == true){
        $('#profile-picture').val('');
        $('.general-form').submit();
      }
  });
});
