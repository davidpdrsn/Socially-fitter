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
$user = new User();
$user = $user->find_by_id($following_id);
$_SESSION["message"] = "You just unfollowed {$user->username}! negative";

redirect_to("profile.php?user_id={$following_id}");

?>
