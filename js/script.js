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

  $('.addmore').live('click', function(e){
    e.preventDefault();
    $('.exercise').last().clone().appendTo('.exercises');
    if ($('.exercise').length > 1) {
      $('.remove').show();
    }
    var label = $('label[for=exercise]').last();
    var number = label.attr('data-number');
    number++;
    label.attr('data-number', number);
  });


  /*$("div").attr("id", function (arr) {
    return "div-id" + arr;
  }).each(function () {
    $("span", this).html("(ID = '<b>" + this.id + "</b>')");
  });*/

  /*$('span.remove').click(function(){
    $(this).parent().remove();
    console.log('Remove clicked');
  });*/

  $('.remove').live('click', function(e){
    e.preventDefault();
    $(this).parent().remove();
    if ($('.exercise').length == 1) {
      $('.remove').hide();
    }
  });

});
