<?php
require_once("inc/controller.php");

if($session->is_logged_in()) {
  $user = new User();
  $user = $user->find_by_id($session->user_id);
  $to = "david.pdrsn.extra@gmail.com";
  $subject = $user->username . " logged out!";
  $body = " ";
  mail($to, $subject, $body);
  $session->logout();
  $_SESSION["message"] = "See ya! positive";
  redirect_to("index.php");
} else {
  redirect_to("index.php");
}

?>
