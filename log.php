<?php
require_once("inc/controller.php");

if(!$session->is_logged_in()){
  redirect_to("timeline.php");
}

if(isset($_POST["submit"])){
  $title = $_POST["title"];
  $body = $_POST["exercise"] . ": " . $_POST["weight"] . " kg, " . $_POST["reps"] . " reps, " . $_POST["sets"] . " sets";
  $time = date("d-m-Y");
  $notes = $_POST["notes"];
  $user_id = $session->user_id;

  $log = new Log();

  $log->title = $title;
  $log->body = $body;
  $log->notes = $notes;
  $log->time = $time;
  $log->user_id = $user_id;
  $log->create();
  $_SESSION["message"] = "Log added! positive";
  redirect_to("timeline.php");

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
