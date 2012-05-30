<?php
require_once("inc/controller.php");

if($session->is_logged_in()){
  redirect_to("timeline.php");
}

if(isset($_POST["submit"])){
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $password_repeat = $_POST["password_repeat"];

  $user = new User();

  if($user->input_validates($username, $email, $password, $password_repeat)){
    $user->username = $username;
    $user->email = $email;
    $user->password = $password;
    $user->create();
    $_SESSION["message"] = "Welcome on board! positive";
    redirect_to("index.php");
  } else {
    // $_SESSION["message"] gets set by the input_validates method
    // so no need to set here
    redirect_to("index.php");
  }
} else { // form has not been submitted
  $_SESSION["message"] = "Something went wrong! negative";
  redirect_to("index.php");
}

?>
