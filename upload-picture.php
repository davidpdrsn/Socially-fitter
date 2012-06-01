<?php
  $page_name = "upload-picture";
  include "inc/head.php";
?>

<br>
<br>

<form action="upload-picture-for-real.php" enctype="multipart/form-data" method="post">
  <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
  <input type="file" name="file_upload">
  <br>
  <input type="submit" name="submit" value="Upload">
</form>

<br>
<br>
<br>
<br>
<br>

<?php
  include "inc/footer.php";
?>
