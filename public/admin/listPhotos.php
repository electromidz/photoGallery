<?php require_once("../../includes/initialize.php"); ?>
<?php if(!$session->isLoggedIn()) { redirect_to("login.php");} ?>

<?php
//find all photos.
$photos = PhotoGraphs::findAll();
includeLayoutTemplate('admin_header.php');
?>

<h2>Photographs</h2>
<?php echo output_message($message); ?>
<table class="bordered">
<tr>
    <th>Images</th>
    <th>Filename</th>
    <th>Caption</th>
    <th>Size</th>
    <th>Type</th>
    <th>&nbsp;</th>
</tr>

<?php foreach($photos as $photo): ?>
<tr>
    <td><img src="../<?php echo $photo->imagePath();?>" width="100px"></td>
    <td><?php echo $photo->filename; ?></td>
    <td><?php echo $photo->caption; ?></td>
    <td><?php echo $photo->sizeAsText(); ?></td>
    <td><?php echo $photo->type; ?></td>
    <td><a href="deletePhoto.php?id=<?php echo $photo->id;?>">Delete</a></td>
</tr>
<?php endforeach; ?>
</table>
<br />
<a href="photoUpload.php">Upload a new photograph</a><br />
<a href="index.php">&laquo; Back</a><br />
