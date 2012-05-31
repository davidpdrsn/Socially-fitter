<?php

require_once("inc/controller.php");

$_POST["exercise1"] = "squats";
$_POST["reps1"] = "100";
$_POST["weight1"] = "30";
$_POST["sets1"] = "3";
$_POST["exercise2"] = "curls";
$_POST["reps2"] = "8";
$_POST["weight2"] = "20";
$_POST["sets2"] = "5";

$body = "";
foreach($_POST as $key=>$value){
  if(strpos($key,"exercise") !== false) {
    $body .= $value . ": ";
  } elseif(strpos($key,"reps") !== false) {
    $body .= $value . " reps, ";
  } elseif(strpos($key,"weight") !== false) {
    $body .= $value . " kg, ";
  } elseif(strpos($key,"sets") !== false) {
    $body .= $value . " sets<br>\n";
  }
}
echo $body;


?>

