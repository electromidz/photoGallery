<?php
$file = 'filetest.txt';
if($handle = fopen($file,'r')){
    $content = fread($handle, 6);
    echo nl2br($content)."<br />";
    fclose($handle);
}
    
    $file = 'filetest.txt';
    if($handle = fopen($file , 'r')){
        $content = fread($handle , filesize($file));
        fclose($handle);
    }
    echo nl2br($content)."<br />";

    $content = file_get_contents($file);
    echo $content;
    echo "<hr>";

    $file = 'filetest.txt';
    $content = "";
    if($handle = fopen($file, 'r')){
        while(!feof($handle)){
            $content .= fgets($handle);
        }
        fclose($handle);
    }
echo $content;
echo "<hr>";