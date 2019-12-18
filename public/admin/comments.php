<?php
require_once('../../includes/initialize.php');
if(!$session->isLoggedIn()){
    redirect_to("login.php");
}
if(empty($_GET['id'])){
    $session->message("No photograph ID was provided.");
    redirect_to("index.php");
}
$photo = PhotoGraphs::findById($_GET['id']);
if(!$photo){
    $session->message("The photo could not be locate.");
    redirect_to("index.php");
}

$comments = $photo->comments();
?>

<?php includeLayoutTemplate('admin_header.php') ?>
        
        <a href="listPhotos.php">&laquo; Back</a><br />
        <br />
        <h2>Comment on <?php echo $photo->filename; ?></h2>
        <?php echo output_message($message); ?>
        

<div id="comment">
    <?php foreach($comments as $comment): ?>
        <div class="comment" style="margin-bottom: 2em;">
            <div class="author">
                <?php echo htmlentities($comment->author);?> wrote:
            </div>
            <div class="body">
                <?php echo strip_tags($comment->body,  '<strong><em><p>');?>
            </div>
            <div class="meta-info" style="font-size: 0.8em;">
                <?php echo datetimeToText($comment->created); ?>
            </div>
            <div class="action" style="font-size: 0.8em;">
                <a href="deleteComment.php?id=<?php echo $comment->id; ?>">Delete comment</a>
            </div>
        </div>
    <?php endforeach; ?>
    <?php
    if(empty($comments)){
        echo "No comments.";
    }
    ?>
</div>

<?php includeLayoutTemplate('admin_footer.php') ?>
