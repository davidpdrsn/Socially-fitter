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

  $('span.addmore').click(function(){
    alert("Aww! You hit me!");
  });

});
