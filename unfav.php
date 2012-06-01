<?php
require_once("inc/controller.php");

if(!$session->is_logged_in() || !isset($_GET["log_id"])){
  redirect_to("timeline.php");
}

$user_id = $session->user_id;
$log_id = $_GET["log_id"];

$fav = new Fav();

$fav->user_id = $user_id;
$fav->log_id = $log_id;
$fav->delete();
$_SESSION["message"] = "Y u no like? negative";
if($_GET["from_page"] == "search"){
  redirect_to($_GET["from_page"] . ".php?query={$_GET["query"]}");
  } else {
  redirect_to($_GET["from_page"] . ".php?user_id={$_GET["user_id"]}");
}

?>