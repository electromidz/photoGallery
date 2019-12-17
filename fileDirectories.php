<?php
echo getcwd() . "<br />";

mkdir('new',  0777);
mkdir('new/test/test2', 0777,true);
chdir('new');
rmdir('test');