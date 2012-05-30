<?php
  $page_name = "landing";
  include "inc/head.php";
?>

<div id="logotype">
  <h1>Socially Fitter <span>is</span></h1>
  <h2>The best way to get fit</h2>
  <a href="#">Learn why</a>
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
<? endif; ?>

<div id="examples">
  <p>hallo</p>
</div>

<?php include "inc/footer.php"; ?>
