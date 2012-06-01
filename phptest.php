<?php

require_once("inc/controller.php");

$upload_errors = array(
    UPLOAD_ERR_OK         => "No errors.",
    UPLOAD_ERR_INI_SIZE   => "Larger than upload_max_filesize.",
    UPLOAD_ERR_FORM_SIZE  => "Larger than form MAX_FILE_SIZE.",
    UPLOAD_ERR_PARTIAL    => "Partial upload.",
    UPLOAD_ERR_NO_FILE    => "No file.",
    UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
    UPLOAD_ERR_CANT_WRITE => "Can't write to disk.",
    UPLOAD_ERR_EXTENSION  => "File upload stopped by extension."
  );

if(isset($_POST["submit"])){
  $tmp_file = $_FILES["file_upload"]["tmp_name"];
  $target_file = basename($_FILES["file_upload"]["name"]);
  $upload_dir = "uploads";

  if (strpos($_FILES["file_upload"]["type"], 'image') !== false) {
    if(move_uploaded_file($tmp_file, $upload_dir."/".$target_file)){
      echo "It worked!";
      echo "<br>";
      echo "<img src='{$upload_dir}/{$target_file}'>";
    } else {
      echo "Did not work...";
    }
  } else {
    echo "File must be an image";
  }

}

echo "<br>";
echo "<br>";

?>
<br>
<hr>
<br>
<form action="phptest.php" enctype="multipart/form-data" method="post">

  <input type="hidden" name="MAX_FILE_SIZE" value="2000000">

  <input type="file" name="file_upload">

  <input type="submit" name="submit" value="Upload">

</form>
