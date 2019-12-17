<?php 
require_once("../../includes/initialize.php");
if(!$session->isLoggedIn()){
    redirect_to("login.php");
}

$logFile = SITE_ROOT.DS.'logs'.DS.'log.txt';

if($_GET['clear'] == 'true'){
    file_put_contents($logFile,'');
    logAction('Log Cleared', "by user ID {$session->userId}");
    redirect_to('logFile.php?clear=false');
}

includeLayoutTemplate('admin_header.php');
?>
<a href="index.php">&laquo; Back</a>
<br />
<h2>Log File</h2>
<p><a href="logFile.php?clear=true">Clear log files</a></p>

<?php
if(file_exists($logFile) && is_readable($logFile)
    && $handle = fopen($logFile, 'r')){
        echo "<ul class=\"log-entries\">";
        while (!feof($handle)) {
            $entry = fgets($handle);
            if(trim($entry) != ""){
                echo "<li>{$entry}</li>";
            }
        }
        echo "</ul>";
        fclose($handle);
}else{
    echo "Could not read from {$logFile}.";
}
includeLayoutTemplate("admin_footer.php");
?>