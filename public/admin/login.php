<?php
require_once('../../includes/initialize.php');

if($session->isLoggedIn()){
    redirect_to("index.php");
}
// Remember to give your fomr`s submit tag a name="submit" attribute
if(isset($_POST['submit'])){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    // Check to data see if username/password
    $foundUser = User::authenticate($username, $password);

    if($foundUser){
        $session->login($foundUser);
        logAction('Login' , "{$foundUser->username} logged in.");
        redirect_to("index.php");
    }else{
        // username/password combo was not found in the database
        $message = "Username/Password combination incorrect.";
    }
}else{
    //Fomr has not been submitted
    $username = "";
    $password = "";
}
?>
<?php includeLayoutTemplate('admin_header.php') ?>
        <h2>Staff Login</h2>
        <?php
        // echo output_message($message)
        ?>
        <form action="login.php" method="post">
            <table>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" maxlength="30" value="<?php echo htmlentities($username)?>">
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" maxlength="30" value="<?php echo htmlentities($password)?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="submit" value="Login">
                    </td>
                </tr>
            </table>
        </form>
<?php includeLayoutTemplate('admin_footer.php') ?>