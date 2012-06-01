<?php
require_once("inc/controller.php");

if(!$session->is_logged_in()){
  redirect_to("timeline.php");
}

if(isset($_POST["comment"])){
  $body = $_POST["comment"];
  $time = date("d-m-Y");
  $user_id = $session->user_id;
  $log_id = $_POST["log_id"];

  $comment = new Comment();

  $comment->body = $body;
  $comment->time = $time;
  $comment->user_id = $user_id;
  $comment->log_id = $log_id;
  $comment->create();
  $_SESSION["message"] = "You just commented! positive";
  redirect_to("profile.php?user_id={$_POST["user_id"]}");

  /* validation of input
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
  */
} else { // form has not been submitted
  $_SESSION["message"] = "Something went wrong! negative";
  redirect_to("index.php");
}

?>
