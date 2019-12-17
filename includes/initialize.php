<?php
// Define the core paths
//Define them as absolute paths to make sure the require_once works as expects
//DIRECTORY_SEPERATOR is a PHP pre_define constant
// (/ for windows , \ for linux)
defined('DS') ? null : define('DS' , DIRECTORY_SEPARATOR);
defined('SITE_ROOT') ? null :
    define('SITE_ROOT',DS. 'xampp'.DS. 'htdocs'.DS. 'photoGallery');
defined('LIB_PATH') ? null : define('LIB_PATH',SITE_ROOT.DS.'includes');

require_once(LIB_PATH.DS.'config.php');
require_once(LIB_PATH.DS.'functions.php');
require_once(LIB_PATH.DS.'session.php');
require_once(LIB_PATH.DS.'user.php');
require_once(LIB_PATH.DS.'database.php');
require_once(LIB_PATH.DS.'databaseObject.php');
require_once(LIB_PATH.DS.'photograph.php');

