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
    //$(this).children().children('.expanded-log').slideToggle('fast');
    $(this).children().children('.expanded-log').fadeSliderToggle();
  });

  $('span.addmore').click(function(){
    alert("Aww! You hit me!");
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
