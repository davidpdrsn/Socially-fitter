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

});
