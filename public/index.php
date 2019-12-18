<?php 
require_once("../includes/initialize.php");

$photos = PhotoGraphs::findAll();

// $user = User::findById(1);
// echo $user->fullName();
// $userSet = User::findAll();
// while($user = $database->fetchAssoc($userSet)){
//     echo "User: ".$user['username']."<br />";
//     echo "Name: ".$user['firstName']." ".$user['lastName']."<br /><br />";
// }
includeLayoutTemplate('header.php');
?>

<?php foreach($photos as $photo): ?>
    <div style="float: left;margin-left:20px;">
        <a href="photo.php?id=<?php  echo $photo->id; ?>">
            <img src="<?php echo $photo->imagePath(); ?>" alt="" style="width: 200px;">
        </a>
        <p><?php echo $photo->caption;?></p>
    </div>

<?php endforeach; ?>


<?php includeLayoutTemplate('footer.php') ?>