<?php
require_once("inc/controller.php");

if ($session->is_logged_in()){
  redirect_to("timeline.php");
}

if (isset($_POST["submit"])) {
  $username = trim($_POST["username"]);
  $password = trim($_POST["password"]);

  $found_user = User::authenticate($username, $password);

  if ($found_user){
    $session->login($found_user);
    $_SESSION["message"] = "Welcome {$username}! positive";

    $to = "david.pdrsn.extra@gmail.com";
    $subject = $username . " just logged in!";
    $body = " ";
    mail($to, $subject, $body);

    redirect_to("timeline.php");

  } else {
    $_SESSION["message"] = "Incorrect username or password. negative";
    redirect_to("index.php");
  }
} else { // form has not been submitted
  $username = "";
  $password = "";
}

?>
