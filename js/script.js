<!-- HIDE MENU BAR WHEN PAGE LOADS -->
addEventListener('load', function() {
  setTimeout(hideAddressBar, 0);
}, false);
function hideAddressBar() {
  window.scrollTo(0, 1);
}
