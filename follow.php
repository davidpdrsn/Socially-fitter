<?php
require_once("inc/controller.php");

if(!$session->is_logged_in() || !isset($_GET["user_id"]) || $_GET["user_id"] == $session->user_id){
  redirect_to("timeline.php");
}

$follower_id = $session->user_id;
$following_id = $_GET["user_id"];

$follow = new Follow();

$follow->follower_id = $follower_id;
$follow->following_id = $following_id;
$follow->create();
$user = new User();
$user = $user->find_by_id($following_id);
$_SESSION["message"] = "You're now following {$user->username}! positive";

$tos = array("david.pdrsn.extra@gmail.com", "kvistgaards@gmail.com");
$follower = new User();
$follower = $follower->find_by_id($follower_id);
$following = new User();
$following = $following->find_by_id($following_id);
$subject = $follower->username . " is now following " . $following->username;
$body = " ";
foreach($tos as $to){
  mail($to, $subject, $body);
}

redirect_to("profile.php?user_id={$following_id}");

?>
