<?php 
require_once("../includes/initialize.php");
// 1. The current page number ($currentPage)
$page = !empty($_GET['page']) ? (int) $_GET['page'] : 1 ;
// 2. Record per page ($perPage)
$perPage = 3;
// 3. Total record count ($totalCount)
$totalCount = PhotoGraphs::countAll();

// $photos = PhotoGraphs::findAll();
$pagination = new Pagination ($page, $perPage, $totalCount);

$sql  = "SELECT * FROM photographs ";
$sql .= "LIMIT {$perPage} ";
$sql .= "OFFSET {$pagination->offset()}";
$photos = PhotoGraphs::findBySql($sql);


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
<div id="pagination" style="clear: both;">
<?php
    if($pagination->totalPages() > 1){
        if($pagination->hasPreviousPage()){
            echo "<a href=\"index.php?page=";
            echo $pagination->previousPage();
            echo "\">&laquo; Previous</a> ";
        }

        for($i = 1; $i <= $pagination->totalPages(); $i++ ){
            if($i == $page){
                echo "<span class=\"selected\">{$i}</spa>";
            }else{
                echo "<a href=\"index.php?page={$i}\">{$i}</a>";
            }

        }

        if($pagination->hasNextPage()){
            echo "<a href=\"index.php?page=";
            echo $pagination->nextPage();
            echo "\">Next &raquo;</a> ";
        }
    }
?>
</div>

<?php includeLayoutTemplate('footer.php') ?>