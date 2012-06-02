<?php
  $page_name = "upload-picture";
  include "inc/head.php";
?>

<div id="upload-picture">
  
  <h2>Upload profile picture</h2>
  <h3>Find a picture and upload it to make it your new profile picture.</h3>
  <h3>To upload a picture, you must do it from a computer and not a smartphone, since it is not supported on this device yet.</h3>

  <form action="upload-picture-for-real.php" enctype="multipart/form-data" method="post">
    <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
    <input type="file" name="file_upload">
    <input type="submit" name="submit" value="Upload">
  </form>

</div> <!-- #upload-picture -->


<?php
  include "inc/footer.php";
?>
