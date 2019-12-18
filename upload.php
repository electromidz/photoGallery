<?php
  echo "<pre>";
  print_r($_FILES['fileUpload']);
  echo "</pre>";
  echo "<hr>";
?>
<html>
  <head>
    <title>Upload</title>
  </head>
  <body>

    <?php
      if(!empty($message)){
        echo "<p>{$message}</p>";
      }
    ?>


    <form action="#" method="post" enctype="multipart/form-data">
      <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
      <input type="file" name="fileUpload" value="">

      <input type="submit" name="submit" value="Upload">
    </form>

  </body>
  </html>
