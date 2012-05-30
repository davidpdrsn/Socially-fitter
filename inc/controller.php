<?php
// display all errors
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once("inc/class.MySQLDatabase.inc.php");
require_once("inc/class.Session.inc.php");

// automatically load classes when they are requested
function __autoload($class_name) {
  include_once 'inc/class.' . $class_name . '.inc.php';
}

function redirect_to($url,$permanent = false){
  if($permanent){
    header('HTTP/1.1 301 Moved Permanently');
  }
  header('Location: '.$url);
  exit();
}

if(isset($_SESSION["message"])){
  $message = $_SESSION["message"];
  unset($_SESSION["message"]);
}

?>
