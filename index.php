<?php
  $page_name = "landing";
  include "inc/head.php";
?>

<div id="logotype">
  <h1>Socially Fitter</h1>
  <h2>Let's get fit together</h2>
  <a href="#seewhy">Learn more</a>
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
  <p>With this web application you can share all your trainings with your friends, family or other people finding your workout interesting. These people can then view your training log, comment on it or even fav it. Also you can follow others and see their training logs, and you can give them advices for improvement in the comments.</p>
  <p>Here is a few examples of the features:</p>
  <img src="images/logging-workout.png" alt="Logging Workout">
  <em>Logging a workout.</em>
  <img src="images/commenting.png" alt="Commenting">
  <em>Commenting on a workout.</em>
  <img src="images/profile.png" alt="Profile">
  <em>Viewing a profile.</em>
  <h4>Take it with you anywhere</h4>
  <p>This web application is designed to fit every device. Which mean that you can use it everywhere. The only thing you need to use this application, is a device with an internet connection.</p>
  <h4>No need to download</h4>
  <p>This application doesn't take any space on your mobile device, but is stored on the web.</p>
  <p>There is a simple way, to simulate a download. Simply add the web application to you Home Screen.</p>
  <p class="clickbutton">Click this button <span class="curvedarrow"></span></p>
  <img src="images/iphone-bottom.png" width="320" height="43" alt="iPhone Bottom" style="padding: 1px 2px 2px 2px;">
</div> <!-- #seewhy -->

<?php include "inc/footer.php"; ?>
