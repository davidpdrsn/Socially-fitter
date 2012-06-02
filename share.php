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

<div id="share" class="clearfix">
  <h2>Share on...</h2>
  <a rel="nofollow" href="http://www.facebook.com/share.php?u=<;url>" onclick="return fbs_click()" target="_blank" class="facebook">Facebook</a>  
  <a href="javascript:(function(){window.twttr=window.twttr||{};var D=550,A=450,C=screen.height,B=screen.width,H=Math.round((B/2)-(D/2)),G=0,F=document,E;if(C>A){G=Math.round((C/2)-(A/2))}window.twttr.shareWin=window.open('http://twitter.com/share?text=I%20just%20logged%20a%20workout%20<?php echo $url; ?>%20&hashtags=SociallyFitter','','left='+H+',top='+G+',width='+D+',height='+A+',personalbar=0,toolbar=0,scrollbars=1,resizable=1');E=F.createElement('script');E.src='http://platform.twitter.com/widgets.js';F.getElementsByTagName('head')[0].appendChild(E)}());" class="twitter">Twitter</a>
  <a href="timeline.php" class="done-sharing">No thanks</a>
</div> <!-- #share -->

<?php include "inc/footer.php"; ?>
