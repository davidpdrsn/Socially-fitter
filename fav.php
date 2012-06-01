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
$fav->create();
$_SESSION["message"] = "Awesome! Spread the love! positive";

$to = "david.pdrsn.extra@gmail.com";
$user = new User();
$user = $user->find_by_id($user_id);
$subject = $user->username . " just faved a log!";
$body = " ";
mail($to, $subject, $body);

if($_GET["from_page"] == "search"){
  redirect_to($_GET["from_page"] . ".php?query={$_GET["query"]}");
} elseif($_GET["from_page"] == "profile") {
  redirect_to($_GET["from_page"] . ".php?user_id={$_GET["user_id"]}");
} elseif($_GET["from_page"] == "timeline") {
  redirect_to($_GET["from_page"] . ".php");
}

?>
