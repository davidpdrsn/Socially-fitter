<?php
require_once("inc/controller.php");

?>

<?php if($session->is_logged_in()): ?>
  <p>
    You are logged in!
  </p>
  <p>
    <a href="logout.php">Logout</a>
  </p>
<?php else: ?>
  <form action="login.php" method="post">
    <label for="username">Username: </label><input type="text" name="username">
    <br>
    <label for="password">Password: </label><input type="password" name="password">
    <br>
    <input type="submit" name="submit" value="login">
  </form>
<?php endif; ?>
