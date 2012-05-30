// hide menu bar
addEventListener('load', function() {
  setTimeout(hideAddressBar, 0);
}, false);
function hideAddressBar() {
  window.scrollTo(0, 1);
}

// fading and slidetoggle
jQuery.fn.fadeSliderToggle = function(settings) {
 	/* Damn you jQuery opacity:'toggle' that dosen't work!~!!!*/
 	 settings = jQuery.extend({
		speed: 300,
		easing: "swing"
	}, settings)

	caller = this
 	if($(caller).css("display") == "none"){
 		$(caller).animate({
 			opacity: 1,
 			height: 'toggle'
 		}, settings.speed, settings.easing);
	}else{
		$(caller).animate({
 			opacity: 0,
 			height: 'toggle'
 		}, settings.speed, settings.easing);
	}
};

$(document).ready(function() {
  
  var fade_not_running = true;
  
  $('.log:not(:animated)').live('click', function() {
    if ($(this).hasClass('open') && fade_not_running) {
      fade_not_running = false;
      $(this).children().children('.expanded-log').animate({
        opacity: 0,
        height: 'toggle'
      }, 300, "swing", function(){
        fade_not_running = true;
      });
      // $(this).children().children('.expanded-log').fadeSliderToggle();
      $(this).removeClass('open');
    }
    else if (fade_not_running){
      //$('.log.open').children().children('.expanded-log').fadeSliderToggle();
      fade_not_running = false;
      $('.log.open').children().children('.expanded-log').animate({
        opacity: 0,
        height: 'toggle'
      }, 300, "swing", function(){
        fade_not_running = true;
      });
      $('.log.open').removeClass('open');
      $(this).addClass('open');
      //$(this).children().children('.expanded-log').fadeSliderToggle();
      $(this).children().children('.expanded-log').animate({
        opacity: 1,
        height: 'toggle'
      }, 300, "swing", function(){
        fade_not_running = true;
      });
    }
  });

  // Add more input fields for logging page
  // Dunno what the live method does but it should help with the clicks not registering
  $('#logging form').delegate('.addmore', 'click', function(e) {
  // $('.addmore').live('click', function(e){
    // Prevent the button from sending you to a new page
    e.preventDefault();
    // clone the last exercise element (with empty input and textarea) and append it to the container
    var cloned = $('.exercise').last().clone();
    cloned.find('input,textarea').val(null);
    $(cloned).appendTo('.exercises');
    // if there more than one show the remove button
    if ($('.exercise').length > 1) {
      $('.remove').show();
    }
    // increment the numbers
    var label = $('label[for=exercise]').last();
    var number = label.attr('data-number');
    number++;
    label.attr('data-number', number);
  });

  // for removing input fields on logging page
  $('.remove').live('click', function(e){
    // Prevent the button from sending you to a new page
    e.preventDefault();
    // remove the input field
    $(this).parent().remove();
    // if there is only one input field left, hide the remove button
    if ($('.exercise').length == 1) {
      $('.remove').hide();
    }
    // decrement the numbers when removing
    var i = 1;
    $('label[for=exercise]').each(function(){
      $(this).attr('data-number', i);
      i++;
    });
  });

  $('.commenting-log').click(function(){
    $(this).parent().parent().parent('.log');
    return false;
  });
  $('.log-comment a').click(function(){
    $(this).parent().parent().parent('.log');
    return false;
  });

  $('.log-comment a').click(function(){
    var $commentinglog = $(this).parent().parent().children('.commenting-log');
    $(this).parent().toggleClass('clicked');
		$commentinglog.fadeSliderToggle();
		return false;
  });

  // for placing footer at bottom, when there are only a few logs 
  $(placeFooterAtBottom);
  
  function placeFooterAtBottom() {
    if (!($(document).height() > $(window).height())) {
        $('#main-footer').css({
          'position': 'fixed',
          'bottom': 0,
          'left': 0
        });
        var wrapHeight = $('#wrap').height();
        $('#wrap').css('height', wrapHeight + 50 + 'px');
    } 
    else {
      $('#main-footer').css('position', 'relative');
      var wrapHeight = $('#wrap').height();
      $('#wrap').css('height', wrapHeight - 50 + 'px');
    }
  }
  
  //Placing wrapper underneath #main-menu
  $menuHeight = $('#main-menu').outerHeight();
  $('#wrap').css('margin-top', $menuHeight + 'px');
  
}); //End of $(document).ready();
