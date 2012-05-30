<?php
// display all errors
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once("inc/class.mysqldatabase.inc.php");

// automatically load classes when they are requested
function __autoload($class_name) {
  include_once 'inc/class.' . $class_name . '.inc.php';
}
?>
