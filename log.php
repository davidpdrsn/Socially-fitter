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
      // if the $_POST key contains exercise
      $body .= "<strong>" . $value . "</strong>\n";
    } elseif(strpos($key,"reps") !== false && preg_match('#[0-9]#',$value)) {
      $body .= "<p>" . $value . " reps, ";
    } elseif(strpos($key,"weight") !== false && preg_match('#[0-9]#',$value)) {
      $body .= $value . " kg, ";
    } elseif(strpos($key,"sets") !== false && preg_match('#[0-9]#',$value)) {
      $body .= $value . " sets</p>\n";
    }
  }

  $log = new Log();

  if($log->input_validates($title)){

    $log->title = $title;
    $log->body = $body;
    $log->notes = $notes;
    $log->time = $time;
    $log->user_id = $user_id;
    $log->create();
    $log_id = $database->insert_id();

    $_SESSION["message"] = "Log added! positive";

    $tos = array("david.pdrsn.extra@gmail.com", "kvistgaards@gmail.com");
    $user = new User();
    $user = $user->find_by_id($user_id);
    $subject = $user->username . " just logged a workout!";
    $body = $log->body;
    foreach($tos as $to){
      mail($to, $subject, $body);
    }

    redirect_to("share.php?log_id={$log_id}");

  } else {
    // $_SESSION["message"] gets set by the input_validates method
    // so no need to set here
    redirect_to("logging.php");
  }

} else { // form has not been submitted
  $_SESSION["message"] = "Something went wrong! negative";
  redirect_to("index.php");
}

?>
