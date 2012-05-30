<?php
require_once("inc/controller.php");

if($session->is_logged_in()){
  redirect_to("timeline.php");
}

if(isset($_POST["submit"])){
  if($_POST["password"] == $_POST["repeat_password"]){
    if(User::username_is_free($_POST["username"])){
      $user = new User();
      $user->username = $_POST["username"];
      $user->email = $_POST["email"];
      $user->password = $_POST["password"];
      $user->create();
      $_SESSION["message"] = "Welcome!";
      redirect_to("index.php");
    } else { // username already taken
      $_SESSION["message"] = "Username already taken";
      redirect_to("index.php");
    }
  } else { // passwords did not match
    $_SESSION["message"] = "Passwords did not match";
    redirect_to("index.php");
  }
} else { // form has not been submitted
  $_SESSION["message"] = "Something went wrong!";
  redirect_to("index.php");
}

?>
