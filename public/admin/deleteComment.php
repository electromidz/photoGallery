<?php require_once("../../includes/initialize.php"); ?>
<?php if(!$session->isLoggedIn()) { redirect_to("login.php");}

if(empty($_GET['id'])){
    $session->message("No comment ID was provided.");
    redirect_to("index.php");
}
$comment = Comment::findById($_GET['id']);
if($comment && $comment->delete()){
    $session->message("The comment was deleted.");
    redirect_to("comments.php?id={$comment->photographId}");
}else{
    $session->message("The comment could not be deleted.");
    redirect_to("listPhotos.php");
}
?>
<?php
if(isset($database)){
    $database->closeConnection();
}
?>