<?php

$filename = 'filetest.txt';
echo filesize($filename)."<br />";

//filetime: last modified (changed content)
//filetime: last changed (changed content or metadata)
//filetime: last accessed (any read/change)

echo strftime('%m/%d/%Y %H:%M' , filemtime($filename)) . "<br />";
echo strftime('%m/%d/%Y %H:%M' , filectime($filename)) . "<br />";
echo strftime('%m/%d/%Y %H:%M' , fileatime($filename)) . "<br />";
touch($filename);
echo strftime('%m/%d/%Y %H:%M' , filemtime($filename)) . "<br />";
echo strftime('%m/%d/%Y %H:%M' , filectime($filename)) . "<br />";
echo strftime('%m/%d/%Y %H:%M' , fileatime($filename)) . "<br />";

echo "<hr>";

$pathParts = pathinfo(__FILE__);
echo $pathParts['dirname']."<br />";
echo $pathParts['basename']."<br />";
echo $pathParts['filename']."<br />";
echo $pathParts['extension']."<br />";
