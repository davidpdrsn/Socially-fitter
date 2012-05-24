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
		speed:300,
		easing : "swing"
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

  $('.log').click(function() {
    if ($(this).hasClass('open')) {
      $(this).children().children('.expanded-log').fadeSliderToggle();
      $(this).removeClass('open');
    }
    else {
      $('.log.open').children().children('.expanded-log').fadeSliderToggle();
      $('.log.open').removeClass('open');
      $(this).addClass('open');
      $(this).children().children('.expanded-log').fadeSliderToggle();
    }
    return false;
  });

  // Add more input fields for logging page
  // Dunno what the live method does but it should help with the clicks not registering
  $('.addmore').live('click', function(e){
    // Prevent the button from sending you to a new page
    e.preventDefault();
    // clone the last exercise element and append it to the container
    $('.exercise').last().clone().appendTo('.exercises');
    // if there is less than one hide the remove button
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

});
