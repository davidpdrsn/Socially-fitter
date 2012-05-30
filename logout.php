<?php
require_once("inc/controller.php");

if($session->is_logged_in()) {
  $session->logout();
  $_SESSION["message"] = "See ya! positive";
  redirect_to("index.php");
} else {
  redirect_to("index.php");
}

?>
