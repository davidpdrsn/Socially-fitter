<?php
  $page_name = "landing";
  include "inc/head.php";
?>

<div id="logotype">
  <h1>Socially Fitter <span>is</span></h1>
  <h2>The best way to get fit</h2>
  <a href="#seewhy">See why</a>
</div>

<?php if(!$session->is_logged_in()): ?>
<div id="signup">
  <h2>Not a member yet?</h2>
  <h3>Sign up right here</h3>
  <form action="signup.php" method="post">
    <input type="text" name="username" placeholder="Your Username">
    <input type="text" name="email" placeholder="Your Email">
    <input type="password" name="password" placeholder="Your Password">
    <input type="password" name="password_repeat" placeholder="Repeat Your Password">
    <input type="submit" name="submit" value="Sign up!" id="submit">
  </form>
</div> <!-- #sign-up -->
<?php endif; ?>

<div id="seewhy" <?php if(!$session->is_logged_in()): ?> class="not-signed" <?php endif; ?>>
  <h2>Is Socially Fitter the best way?</h2>
  <h3>In short: Yes! Socially Fitter is the best way to get fit, and here is three reasons why:</h3>
  <h4>Making workout social</h4>
  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
  <h4>Take it with you anywhere</h4>
  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
  <h4>No need to download</h4>
  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
</div> <!-- #seewhy -->

<?php include "inc/footer.php"; ?>
