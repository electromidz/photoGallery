<?php
require_once(LIB_PATH.DS.'databaseObject.php');

class PhotoGraphs extends databaseObject {
    protected static $tableName = "photographs";
    protected static $dbFields = array('id', 'filename', 'type', 'size', 'caption');
    public $id;
    public $filename;
    public $type;
    public $size;
    public $caption;
}

