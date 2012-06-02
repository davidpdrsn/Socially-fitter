<?php
  $page_name = "share";
  include "inc/head.php";

  $url = "http://mmd4s12b12.keaweb.dk/single-log.php?log_id=" . $_GET["log_id"];
?>

<script>
  function fbs_click() {
    u="<?php echo $url; ?>";
    t=document.title;
    window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');
    return false;
  }
</script>

<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

<div id="share">
  <a rel="nofollow" href="http://www.facebook.com/share.php?u=<;url>" onclick="return fbs_click()" target="_blank">Share on Facebook</a>

  <br>
  <br>

  <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $url; ?>" data-text="I just logged a workout!" data-size="large" data-count="none" data-hashtags="sociallyfitter">Tweet</a>

  <br>
  <br>

  <a href="timeline.php">I'm done sharing!</a>
</div> <!-- #share -->

<?php include "inc/footer.php"; ?>
