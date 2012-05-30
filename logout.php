<?php
require_once("inc/controller.php");

if($session->is_logged_in()) {
  $session->logout();
  redirect_to("phptest.php");
} else {
  redirect_to("login.php");
}

?>
