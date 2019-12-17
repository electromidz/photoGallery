<?php
$uploadError = array(
  UPLOAD_ERR_OK => "No errors.",
  UPLOAD_ERR_INI_SIZE => "Larger than upload_max_filesize.",
  UPLOAD_ERR_FORM_SIZE => "Larger than from MAX_FILE_SIZE.",
  UPLOAD_ERR_PARTIAL => "Partial upload.",
  UPLOAD_ERR_NO_FILE => "No file.",
  UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
  UPLOAD_ERR_CANT_WRITE => "Can`t write to disk.",
  UPLOAD_ERR_EXTENSION => "File upload stopPed by extension."
);

if(isset($_POST['submit'])){
  $tmpFile = $_FILES['fileUpload']['tmp_name'];
  $targetFile = basename($_FILES['fileUpload']['name']);
  $uploadDir = 'uploads';

  if(move_uploaded_file($tmpFile, $uploadDir . "/" . $targetFile)){
      echo "File uploaded successfully.";
  }else{
    $error = $_FILES['fileUpload']['error'];
    $message = $uploadError[$error];
  }
}




  echo "<pre>";
  // print_r ($_FILES['fileUpload']);
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


    <form action="upload.php" method="post" enctype="multipart/form-data">
       <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
       <input type="file" name="fileUpload" value="">

       <input type="submit" name="submit" value="Upload">
    </form>

  </body>
  </html>
