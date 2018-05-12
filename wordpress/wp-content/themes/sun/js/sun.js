jQuery(document).ready(function ($) {
  //Custom sun script

  revealPost();
  //Declare variables
  var lastScroll = 0;
var id = $("#" + $('.sun-gallery-slide').attr('id'));

  $(document).on('mouseenter', '.sun-gallery-slide', function () {
    var id = $("#" + $(this).attr('id'));
    //Initialize carousel
    sun_do_slide(id);
    //For dynamic loading of carousel
    $(id).on('slid.bs.carousel', function () {
      sun_do_slide(this);
    });

 //   console.log( id );
 //    //$(this).find('.preview-container').find('.thumbnail-container').css({'background-image' : 'url('+nextThumb+')'});
   });
  function sun_do_slide( id ){
    $(id).each(function () {
      var nextThumb = $(this).find('.item.active').find('.next-image-preview').data('image');
      var prevThumb = $(this).find('.item.active').find('.prev-image-preview').data('image');
       $(this).find('.carousel-control.right').find('.preview-container').find('.thumbnail-container').css({'background-image' : 'url('+nextThumb+')'});
       $(this).find('.carousel-control.left').find('.preview-container').find('.thumbnail-container').css({'background-image' : 'url('+prevThumb+')'});
    });
    }
// Social media share
$(document).on('mouseenter', '.share:not(.rotate)', function () {
var share = $("#" + $(this).attr('id'));
//console.log(share);
$('.sun-share').find(share).addClass('rotate');
setTimeout(function () {
  $('.sun-share').find(share).removeClass('rotate');
},400);
});

$(document).on('click', '.js-sun-toggle', function () {
$('.sun-front-sidebar').toggleClass('sun-closed');
$('body').toggleClass('no-scroll');
$('.sidebar-overlay').fadeToggle(500);
});

$('.contact-form-class').on('submit', function (e) {
  e.preventDefault();
  $('.has-error').removeClass('has-error');
 var form = $(this);
 var name = form.find('#name').val();
 var email = form.find('#email').val();
 var message = form.find('#message').val();
 var ajaxurl = form.find('#btn').data('submit');
 if(name == ''){
   form.find('#name').parent('.form-group').addClass('has-error');
   //form.find('.sun-name').removeClass('form-control-msg');
   return;
 }
 if(email == ''){
   form.find('#email').parent('.form-group').addClass('has-error');
   //form.find('.sun-email').removeClass('form-control-msg');
   return;
 }
 else if(email != ''){
   if (!(/[@]/.test(email)) || !(/[.]/.test(email))){
     form.find('#email').parent('.form-group').addClass('has-error');
     return;
   }
 }
 if(message == ''){
   form.find('#message').parent('.form-group').addClass('has-error');
   //form.find('.sun-message').removeClass('form-control-msg');
   return;
 }
 form.find('input, textarea, button').attr('disabled', 'disabled');
 form.find('.sun-message-processed').fadeToggle(400);
 form.find('#btn').html('Please wait...');
 form.find('#btn').parent('.form-group').toggleClass('has-success');
 form.find('.has-success').find('.fa-spinner').toggleClass('spin');
 $.ajax({
   url    : ajaxurl,
   type   : 'post',
   data     : {
     name: name,
     email: email,
     message: message,
     action : 'sun_save_contact_form_callback'
   },
   error : function (response) {
     form.find('.sun-message-processed').fadeToggle(400);
     setTimeout(function () {
       form.find('#btn').parent('.form-group').toggleClass('has-success');
       form.find('input, textarea, button').removeAttr('disabled');
       form.find('#btn').html('Submit');
       form.find('.sun-message-fail').toggleClass('form-control-msg');
     setTimeout(function () {
       form.find('.sun-message-fail').toggleClass('form-control-msg');
     },5000);
  },2000);
   },
   success : function (response) {
     if(response == 0){
       form.find('.sun-message-processed').fadeToggle(400);
       setTimeout(function () {
         form.find('#btn').parent('.form-group').toggleClass('has-success');
         form.find('input, textarea, button').removeAttr('disabled');
         form.find('#btn').html('Submit');
         form.find('.sun-message-fail').toggleClass('form-control-msg');
       setTimeout(function () {
         form.find('.sun-message-fail').toggleClass('form-control-msg');
       },5000);
    },2000);
     }else {

       form.find('.sun-message-processed').fadeToggle(400);
       setTimeout(function () {
         form.find('#btn').parent('.form-group').toggleClass('has-success');
         form.find('input, textarea, button').removeAttr('disabled');
         form.find('input, textarea').val('');
         form.find('#btn').html('Submit');
         form.find('#btn').addClass('fa fa-reload');
         form.find('.sun-message-sent').toggleClass('form-control-msg');
       setTimeout(function () {
         form.find('.sun-message-sent').toggleClass('form-control-msg');
       },5000);
    },1000);
     }
   }
 });
});
// removal of has-error class when input field in not empty
$('.contact-form-class').find('#name').on('blur', function (e) {
  var name = $(this).val();
  if(name != '')
    $(this).parent('.form-group').removeClass('has-error');
  });
  $('.contact-form-class').find('#email').on('blur', function (e) {
    var email = $(this).val();
    if(email != '' && ((/[@]/.test(email)) && (/[.]/.test(email))))
      $(this).parent('.form-group').removeClass('has-error');
    });
    $('.contact-form-class').find('#message').on('blur', function (e) {
      var message = $(this).val();
      if(message != '')
        $(this).parent('.form-group').removeClass('has-error');
      });
  /*Ajax functions*/
  $(document).on('click', '.sun-load-more:not(.loading)', function () {
    var that = $(this);
    var page = that.data('page');
    var newPage = page + 1;
    var ajaxurl = that.data('url');
    var prev = that.data('prev');
    var archive = that.data('archive');
    if (typeof prev === 'undefined') {
      prev = 0;
    }
    if (typeof archive === 'undefined') {
      archive = 0;
    }
    that.addClass('loading').find('.text').slideUp(100);
    that.find('.fa').addClass('spin');
    //console.log(page);
    $.ajax({
      url     :   ajaxurl,
      type    :   'post',
      data    :   {
        page  :   page,
        prev  :   prev,
        archive:  archive,
        action:   'sun_load_more_post'
      },
      error   :   function(response) {
        console.log(response);
      },
      success :   function (response) {
        if (response == 0) {
          that.slideUp(100);
        }
        if (prev == 1) {
          $('.sun-post-container').prepend(response);
          newPage = page - 1;
        }else {
          $('.sun-post-container').append(response);
        }
        if (newPage == 1) {
          that.slideUp(100);
        }
        that.data('page', newPage);
        revealPost();

        setTimeout(function () {
          that.find('.fa').removeClass('spin');
          that.removeClass('loading').find('.text').slideDown(100);

        }, 100);

      }
    });
  });
  /*Scroll*/
  $(window).scroll(function () {
    var scroll = $(window).scrollTop();
    if ( Math.abs(scroll - lastScroll) > $(window).height()*0.1) {
      lastScroll = scroll;
      $('.page-limit').each(function (index) {
        if( isVisible( $(this))){
          history.replaceState(null, null, $(this).attr("data-page"));
          //return(false);

        }
      });
    }
  });
  //Helper functions
  function revealPost(){
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover();
    var posts = $('article:not(.reveal)');
    var i = 0;
    setInterval(function () {
      if(i >= posts.length)return false;
      var el = posts[i];
      $(el).addClass('reveal').find('.sun-gallery-slide').carousel();
      i++;
    }, 200);
  }

  function isVisible(element){
      var scrollPos = $(window).scrollTop();
      var windowHeight = $(window).height();
      var elTop = $(element).offset().top;
      var elHeight = $(element).height();
      var elBottom = elTop + elHeight;
      return ((elBottom - elHeight*0.25 > scrollPos) && (elTop < (scrollPos+0.5*windowHeight)));
  }
});
