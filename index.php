<?php
  $page_name = "landing";
  include "inc/head.php";
?>

<div id="logotype">
  <h1>Socially Fitter</h1>
  <h2>Making workout social</h2>
</div>

<div id="signup">
  <h2>Not a member yet?</h2>
  <h3>Sign up right here</h3>
  <form action="signup.php">
    <input type="text" name="name" placeholder="Your Name">
    <input type="text" name="email" placeholder="Your Email">
    <input type="password" name="password" placeholder="Your Password">
    <input type="password" name="repeat_password" placeholder="Repeat Your Password">
    <input type="submit" name="submit" value="Sign up!" id="submit">
  </form>
</div> <!-- #sign-up -->

<div id="examples">
  <h2>What is Socially Fitter?</h2>
  <h3>Socially Fitter is a place for you to share your training in a fast and effective way.</h3>
  <h3>Here are a few examples:</h3>
</div> <!-- #examples -->

<?php include "inc/footer.php"; ?>
