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
          $('.error-message').delay(100).animate({
            top: 0
          });
          $('.error-message').delay(2000).animate({
            top: -53
          });
        }
      });
    </script>

    <div class="error-message">
      <h2><?= $message; ?></h2>
    </div>

  <?php endif; ?>




</body>
</html>
