<?php
include "inc/controller.php";
if($session->is_logged_in()){
  //
} else {
  if($page_name !== "landing" && $page_name !== "single"){
    if(!isset($session->user_id) && $page_name !== "landing" || $session->is_logged_in() && $page_name !== "landing"){
      $_SESSION["message"] = "Login to access this page. negative";
      redirect_to("index.php");
    }
  }
}
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

  <!-- For third-generation iPad with high-resolution Retina display: -->
  <link rel="apple-touch-icon" sizes="144x144" href="apple-touch-icon-144x144.png">
  <!-- For iPhone with high-resolution Retina display: -->
  <link rel="apple-touch-icon" sizes="114x114" href="apple-touch-icon-114x114.png">
  <!-- For first- and second-generation iPad: -->
  <link rel="apple-touch-icon" sizes="72x72" href="apple-touch-icon-72x72.png">
  <!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
  <link rel="apple-touch-icon" href="apple-touch-icon.png">

  <title>Socially Fitter - The best way to get fit</title>

  <link rel="stylesheet" type="text/css" href="css/global.css">
  <?php if($page_name == "landing"): ?>
    <link rel="stylesheet" type="text/css" href="css/landing.css">
  <?php elseif($page_name == "logging"): ?>
    <link rel="stylesheet" type="text/css" href="css/logging.css">
  <?php elseif($page_name == "profile"): ?>
    <link rel="stylesheet" type="text/css" href="css/profile.css">
  <?php elseif($page_name == "search"): ?>
    <link rel="stylesheet" type="text/css" href="css/search.css">
  <?php elseif($page_name == "share"): ?>
    <link rel="stylesheet" type="text/css" href="css/share.css">
  <?php elseif($page_name == "timeline"): ?>
    <link rel="stylesheet" type="text/css" href="css/timeline.css">
  <?php elseif($page_name == "upload-picture"): ?>
    <link rel="stylesheet" type="text/css" href="css/upload-picture.css">
  <?php elseif($page_name == "single"): ?>
    <link rel="stylesheet" type="text/css" href="css/profile.css">
  <?php endif; ?>

  <link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700|Lobster' rel='stylesheet' type='text/css'>

</head>
<body>

  <div id="wrap">

      <?php include "inc/menu.php"; ?>
