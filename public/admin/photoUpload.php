<?php
require_once('../../includes/initialize.php');
if(!$session->isLoggedIn()){
    redirect_to("login.php");
}
?>
<?php includeLayoutTemplate('admin_header.php') ?>
<?php
$maxFileSize = 1048576;

if (isset($_POST['submit'])){
    $photo = new  PhotoGraphs();
    $photo->caption = $_POST['caption'];
    $photo->attachFile($_FILES['fileUpload']);
    if($photo->save()){
        //Success
        $session->message("Photograph uploaded successfully.");
        redirect_to("listPhotos.php");
    }else{
        //Failure.
        $message = join("<br />", $photo->errors);
    }
}
?>
<h2>Photo Upload</h2>
<?php echo output_message($message); ?>
<form action="photoUpload.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $maxFileSize; ?>">
    <p><input type="file" name="fileUpload"></p>
    <p>Caption: <input type="text" name="caption" value=""></p>
    <input type="submit" name="submit" value="Upload">
</form>

<?php includeLayoutTemplate('admin_footer.php') ?>
