<?php
require_once(LIB_PATH.DS.'database.php');

class Comment extends databaseObject{
    protected static $tableName = "comments";
    protected static $dbFields = array('photographId', 'created', 'author', 'body');
    public $id;
    public $photographId;
    public $created;
    public $author;
    public $body;

    public static function make($photoId, $author = "Anonymous", $body = ""){
        if(!empty($photoId) && !empty($author) && !empty($body)){
            $comment = new Comment();
            $comment->photographId = (int) $photoId;
            $comment->created = strftime("%Y-%m-%d %H:%M:%S" , time());
            $comment->author = $author;
            $comment->body = $body;
            return $comment;
        }else{
            return false;
        }
    }

    public static function findCommentOn($photoId = 0){
        global $database;
        $sql  = "SELECT * FROM ". self::$tableName;
        $sql .= " WHERE photographId=" . $database->escapeValue($photoId);
        $sql .= " ORDER BY created ASC";
        return self::findBySql($sql); 
    }
}