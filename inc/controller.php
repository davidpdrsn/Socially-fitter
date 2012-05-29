<?php
// display all errors
error_reporting(E_ALL);
ini_set('display_errors', '1');

// automatically load classes when they are requested
function __autoload($class_name) {
  include_once 'inc/class.' . $class_name . '.inc.php';
}
?>
