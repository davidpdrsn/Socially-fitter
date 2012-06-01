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
$follow->unfollow();
$_SESSION["message"] = "You just unfollowed {$following_id}! negative";
redirect_to("profile.php?user_id={$following_id}");

?>
