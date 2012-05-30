<?php
  $page_name = "landing";
  include "inc/head.php";
  require_once("inc/class.user.inc.php");
?>

<div id="logotype">
  <h1>Socially Fitter</h1>
  <h2>Making workout social</h2>
</div>

<div id="signup">
  <h2>Not a member yet?</h2>
  <h3>Sign up right here</h3>
  <form action="signup.php">
    <!--label for="signup-name">Your name:</label--><input type="text" name="signup-name" placeholder="Your Name" id="signup-name">
    <!--label for="signup-email">Your email:</label--><input type="text" name="signup-email" placeholder="Your Email" id="signup-email">
    <!--label for="signup-password">Your password:</label--><input type="password" name="signup-password" placeholder="Your Password" id="signup-password">
    <!--label for="repeat_password">Repeat password:</label><input type="password" name="repeat_password" placeholder="&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;" id="repeat_password"-->
    <input type="password" name="repeat_password" placeholder="Repeat Your Password" id="repeat_password">
    <input type="submit" name="signup-submit" value="Sign up!" id="signup-submit" class="login">
  </form>
</div> <!-- #sign-up -->

<!--div id="login-area">
  <h2>Already a member?</h2>
  <h3><span class="glyph general">u</span> Log in right here <span class="glyph general">v</span></h3>
  <form action="login.php">
    <input type="text" name="login-email" placeholder="Your Email" id="signup-email">
    <input type="password" name="login-password" placeholder="Your Password" id="login-password">
    <input type="submit" name="login-submit" value="Log in!" id="login-submit">
  </form>
</div>  #sign-up -->

<div id="examples">
  <h2>What is Socially Fitter?</h2>
  <h3>Socially Fitter is a place for you to share your training in a fast and effective way.</h3>
  <h3>Here are a few examples:</h3>
</div> <!-- #examples -->

<?php include "inc/footer.php"; ?>
