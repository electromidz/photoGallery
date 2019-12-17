<?php
require_once('../../includes/initialize.php');
if(!$session->isLoggedIn()){
    redirect_to("login.php");
}
?>
<?php includeLayoutTemplate('admin_header.php') ?>

<?php
//    $user = new User();
//    $user->username = "johnsmith";
//    $user->password = "1234";
//    $user->firstName = "John";
//    $user->lastName = "Smith";
//    $user->create();

//    $user = User::findById(2);
//    $user->password = "1234";
//    $user->save();

    $user = User::findById(2);
    $user->delete();
?>

<?php includeLayoutTemplate('admin_footer.php') ?>
