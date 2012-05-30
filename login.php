<?php
require_once("inc/controller.php");

if ($session->is_logged_in()){
  redirect_to("phptest.php");
}

if (isset($_POST["submit"])) {
  $username = trim($_POST["username"]);
  $password = trim($_POST["password"]);

  $found_user = User::authenticate($username, $password);

  if ($found_user){
    $session->login($found_user);
    redirect_to("phptest.php");
  } else {
    $message = "Incorrect username or password";
  }
} else { // form has not been submitted
  $username = "";
  $password = "";
}

?>
