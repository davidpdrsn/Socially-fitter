<?php
require_once("inc/controller.php");

if(!$session->is_logged_in()){
  redirect_to("timeline.php");
}

if(isset($_POST["submit"])){
  $title = $_POST["title"];
  $time = date("d-m-Y");
  //$notes = str_replace("\n", "<br>", $_POST["notes"]);
  $notes = $_POST["notes"];
  $user_id = $session->user_id;
  $body = "";
  foreach($_POST as $key=>$value){
    if(strpos($key,"exercise") !== false) {
      $body .= "<strong>" . $value . "</strong>\n";
    } elseif(strpos($key,"reps") !== false) {
      $body .= "<p>" . $value . " reps, ";
    } elseif(strpos($key,"weight") !== false) {
      $body .= $value . " kg, ";
    } elseif(strpos($key,"sets") !== false) {
      $body .= $value . " sets</p>\n";
    }
  }

  $log = new Log();

  $log->title = $title;
  $log->body = $body;
  $log->notes = $notes;
  $log->time = $time;
  $log->user_id = $user_id;
  $log->create();
  $log_id = $database->insert_id();

  $_SESSION["message"] = "Log added! positive";

  $to = "david.pdrsn.extra@gmail.com";
  $user = new User();
  $user = $user->find_by_id($user_id);
  $subject = $user->username . " just logged a workout!";
  $body = $log->body;
  mail($to, $subject, $body);

  redirect_to("share.php?log_id={$log_id}");

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
