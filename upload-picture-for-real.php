<?php
require_once("inc/controller.php");

if(!$session->is_logged_in()){
  redirect_to("timeline.php");
}

if(isset($_POST["submit"])){

  $tmp_file = $_FILES["file_upload"]["tmp_name"];
  $target_file = basename($_FILES["file_upload"]["name"]);
  $upload_dir = "uploads";
  $final_path = $upload_dir."/".$target_file;

  if (strpos($_FILES["file_upload"]["type"], 'image') !== false) {
    if(move_uploaded_file($tmp_file, $upload_dir."/".$target_file)){
      $user = new User();
      $user = $user->find_by_id($session->user_id);
      $user->profile_picture = $final_path;
      $user->update();

      $_SESSION["message"] = "Picture uploaded! positive";

      redirect_to("profile.php?user_id={$session->user_id}");
    } else {
      echo "Did not work...";
    }
  } else {
    echo "File must be an image";
  }

} else { // form has not been submitted
  $_SESSION["message"] = "Something went wrong! negative";
  redirect_to("index.php");
}

?>
