<?php 
require_once("../includes/functions.php");
require_once("../includes/database.php");
// require_once("../includes/user.php");

// $user = User::findById(1);
// echo $user->fullName();
// $userSet = User::findAll();
// while($user = $database->fetchAssoc($userSet)){
//     echo "User: ".$user['username']."<br />";
//     echo "Name: ".$user['firstName']." ".$user['lastName']."<br /><br />";
// }
includeLayoutTemplate('header.php')

$users = User::findAll();
foreach($users as $user){
    echo "User: ". $user->username."<br />";
    echo "Name: ". $user->fullName()."<br /><br />";
}
includeLayoutTemplate('footer.php')
?>