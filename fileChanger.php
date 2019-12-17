<?php
echo fileowner('filePermission.php');
echo "<br />";
 $ownerId = fileowner('filePermission.php');
 $ownerArray = posix_getpwuid($ownerId);
//  echo $ownerArray['name'];

?>