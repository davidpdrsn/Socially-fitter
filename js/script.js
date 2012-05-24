// hide menu bar
addEventListener('load', function() {
  setTimeout(hideAddressBar, 0);
}, false);
function hideAddressBar() {
  window.scrollTo(0, 1);
}

$(document).ready(function() {

  $('.log').click(function() {
    $(this).children().children('.expanded-log').slideToggle('fast');
  });

  /*$('span.addmore').click(function(){
    $('.exercise').last().clone().appendTo('.exercises');
    console.log('Add clicked');
    $('span.remove').show();
  });*/

  $('.addmore').live('click', function(e){
    e.preventDefault();
    $('.exercise').last().clone().appendTo('.exercises');
    console.log('Add clicked');
    if ($('.exercise').length > 1) {
      $('.remove').show();
    }
  });

  /*$('span.remove').click(function(){
    $(this).parent().remove();
    console.log('Remove clicked');
  });*/

  $('.remove').live('click', function(e){
    e.preventDefault();
    $(this).parent().remove();
    console.log('Remove clicked');
    if ($('.exercise').length == 1) {
      $('.remove').hide();
    }
  });


});
