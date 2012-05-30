<?php

require_once("inc/controller.php");

$username = "mad";
$email = "email@hej.com";
$password = "password";
$password_repeat = "password";

$user = new User();
if($user->input_validates($username, $email, $password, $password_repeat)){
  // does validate
} else {
  // doesn't validate
}

?>

