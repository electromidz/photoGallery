<?php
echo __FILE__."<br />"; 
echo __LINE__ . "<br />"; //be careful once you include files
echo dirname(__FILE__) . "<br />";
echo __DIR__ . "<br />";
echo file_exists(__DIR__."/basic.html") ? 'Yes' : 'no';
echo "<br />";
echo file_exists(__DIR__) ? 'Yes' : 'no';
echo "<br />"; 

echo is_file(__DIR__."/basic.html") ? 'Yes' : 'no';
echo "<br />";
echo is_file(__DIR__) ? 'Yes' : 'no';
echo "<br />"; 

echo is_dir(__DIR__."/basic.html") ? 'Yes' : 'no';
echo "<br />";
echo is_dir(__DIR__) ? 'Yes' : 'no';
echo "<br />";
echo is_dir('..') ? 'Yes' : 'no';
echo "<br />";
?>