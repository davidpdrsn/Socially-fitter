<?php
require_once("inc/controller.php");

if($session->is_logged_in()){
  redirect_to("timeline.php");
}

if(isset($_POST["submit"])){
  $user = new User();
  $user->username = $_POST["username"];
  $user->email = $_POST["email"];
  $user->password = $_POST["password"];
  $user->create();
  $_SESSION["message"] = "Welcome!";
  redirect_to("index.php");
} else { // form has not been submitted
  $_SESSION["message"] = "Something went wrong!";
}

?>
