<footer id="main-footer" class="clearfix">
  <h2>Socially Fitter</h2>
  <?php if($session->is_logged_in()): ?>
    <a href="logout.php" class="logout">Logout</a>
  <?php endif; ?>
</footer>

  </div> <!-- #wrap -->

  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/script.js"></script>

  <?php if(isset($message)): ?>

    <script type="text/javascript">
      $(document).ready(function(){
        $(errorInLogin);

        function errorInLogin() {
          var messageHeight = $('.error-message').outerHeight();
          $('.error-message').css('top', -messageHeight+1+'px');
          $('.error-message').delay(100).animate({
            top: -1
          });
          $('.error-message').delay(1300).animate({
            top: -messageHeight-1
          });
        }
      });
    </script>

    <?php
      // if $message contains the word positive
      if (strpos($message, 'positive')) {
        $message_kind = "positive";
      } else {
        $message_kind = "negative";
      }
      // remove the last word from $message
      $message = substr($message, 0, strrpos($message, " "));
    ?>
      <div class="error-message <?= $message_kind; ?>">
      <h2><?= $message; ?></h2>
    </div>

  <?php endif; ?>

</body>
</html>
