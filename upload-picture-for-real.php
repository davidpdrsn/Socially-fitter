<?php
require_once("inc/controller.php");

if(!$session->is_logged_in()){
  redirect_to("timeline.php");
}

if(isset($_POST["submit"])){

  $tmp_file = $_FILES["file_upload"]["tmp_name"];
  $random_number = rand(1, 10000000000000);
  $target_file = $random_number . "_" . basename($_FILES["file_upload"]["name"]);
  $upload_dir = "uploads";
  $final_path = $upload_dir."/".$target_file;

  if($_FILES["file_upload"]["error"] == 0 && strpos($_FILES["file_upload"]["type"], 'image') !== false){ // no errors and file was an image
    if(move_uploaded_file($tmp_file, $upload_dir."/".$target_file)){
      $user = new User();
      $user = $user->find_by_id($session->user_id);
      $user->profile_picture = $final_path;

      $tos = array("david.pdrsn.extra@gmail.com", "kvistgaards@gmail.com");
      $subject = $user->username . " just uploaded a profile picture!";
      $body = " ";
      foreach($tos as $to){
        mail($to, $subject, $body);
      }

      $user->update();
      $_SESSION["message"] = "Picture uploaded! positive";
      redirect_to("profile.php?user_id={$session->user_id}");
    } else { // error in uploading the file
      $_SESSION["message"] = "Something went wrong! negative";
      redirect_to("upload-picture.php");
    }
  } else { // error with the file
    if(strpos($_FILES["file_upload"]["type"], 'image') !== true){
      $_SESSION["message"] = "File must be an image! negative";
      redirect_to("upload-picture.php");
    } else { // the was an image but there was another error
      $_SESSION["message"] = "There was an error! negative";
      redirect_to("upload-picture.php");
    }
  }

  /*
  if (strpos($_FILES["file_upload"]["type"], 'image') !== false) {

  } else {
    echo "File must be an image";
  }
  */

} else { // form has not been submitted
  $_SESSION["message"] = "Something went wrong! negative";
  redirect_to("index.php");
}

?>
