<footer id="main-footer" class="clearfix">
  <h2>Socially Fitter</h2>
  <?php if($session->is_logged_in()): ?>
    <a href="logout.php" class="logout">Logout</a>
  <?php endif; ?>
</footer>

  </div> <!-- #wrap -->

  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/script.js"></script>

</body>
</html>
