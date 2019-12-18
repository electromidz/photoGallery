<?php require_once("../../includes/initialize.php"); ?>
<?php if(!$session->isLoggedIn()) { redirect_to("login.php");}
if(empty($_GET['id'])){
    $session->message("No photograph ID was provided.");
    redirect_to("index.php");
}

$photo = PhotoGraphs::findById($_GET['id']);
if($photo && $photo->destroy()){
    $session->message("The photo {$photo->filename} was deleted.");
    redirect_to("listPhotos.php");
}else{
    $session->message("The photo could not be deleted.");
    redirect_to("listPhotos.php");
}
?>

<?php
if(isset($database)){
    $database->closeConnection();
}
?>