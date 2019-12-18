<?php
require_once('../../includes/initialize.php');
if(!$session->isLoggedIn()){
    redirect_to("login.php");
}
?>

<?php includeLayoutTemplate('admin_header.php') ?>
        <h2>Menu</h2>
        <?php echo output_message($message); ?>
        <ul>
        <li><a href="listPhotos.php">List photos</a></li>
        <li><a href="logFile.php?clear=false">View log file</a></li>
        <li><a href="logout.php">Logout</a></li>
        </ul>
<?php includeLayoutTemplate('admin_footer.php') ?>
