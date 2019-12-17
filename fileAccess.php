<?php

$file = 'filetest.txt';
if ($handle = fopen($file,'w')){
    fwrite($handle, 'abc'); // return number of bytes or false
    $content = "123\n456"; // double quotes matter (with \n)
    fwrite($handle,$content);

    fclose($handle);
}else{
    echo "Could not open file for writing.";
}

//file put content

$file = 'filetest.txt';
$content = "111\n222\n333";
if($size = file_put_contents($file,$content)){
    echo "A file of {$size} bytes was created.";
}
?>