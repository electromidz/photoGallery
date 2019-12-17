<?php
$dir = ".";
if(is_dir($dir)){
    if($dirHandle = opendir($dir)){
        while ($filename = readdir($dirHandle)) {
            echo "filename: {$filename} <br />";
        }

        closedir($dirHandle);

    }
}

echo "<hr>";

// scandir(); reads all filename into an array
if(is_dir($dir)){
    $dirArray = scandir($dir);
    foreach ($dirArray as $file) {
        if(stripos($file , ".") > 0 ){
            echo "filename: {$file} <br />";
        }
    } 
}

?>