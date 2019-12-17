<?php
require_once('../../includes/initialize.php');
if(!$session->isLoggedIn()){
    redirect_to("login.php");
}
?>
<?php includeLayoutTemplate('admin_header.php') ?>
<?php
$maxFileSize = 1048576;

$message = "";
if (isset($_POST['submit'])){
    $photo = new  PhotoGraphs();
    $photo->caption = $_POST['caption'];
    $photo->attachFile($_FILES['fileUpload']);
    if($photo->save()){
        //Success
        $message = "Photograph uploaded successfully.";
    }else{
        //Failure.
        $message = join("<br />", $photo->errors);
    }

}
?>
<h2>Photo Upload</h2>

<form action="photoUploasd.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $maxFileSize; ?>">
    <p><input type="text" name="fileUpload"></p>
    <p>Caption: <input type="text" name="caption" value=""></p>
    <input type="submit" name="submit" value="Upload">
</form>

<?php includeLayoutTemplate('admin_footer.php') ?>
