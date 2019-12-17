<?php
require_once(LIB_PATH.DS.'databaseObject.php');
// require_once('databaseObject.php');

class User extends databaseObject {

    protected static $tableName = "users";
    protected static $dbFields = array('id', 'username', 'password', 'firstName', 'lastName');
    public $id;
    public $username;
    public $password;
    public $firstName;
    public $lastName;

    public static function authenticate($username = "", $password = ""){
        global $database;
        $username = $database->escapeValue($username);
        $password = $database->escapeValue($password);

        $sql  = "SELECT * FROM users ";
        $sql .= "WHERE username = '{$username}' ";
        $sql .= "AND password = '{$password}' ";
        $sql .= "LIMIT 1";
        $resultArray = self::findBySql($sql);
        return !empty($resultArray) ? array_shift($resultArray) : false;

    }

    public function fullName(){
        if(isset($this->firstName) && isset($this->lastName)){
            return $this->firstName . " " . $this->lastName;
        }else{
            return "";
        }
    }

    protected function attribute(){
        $attribute = array();
        foreach (self::$dbFields as $field){
            if(property_exists($this, $field)){
                $attribute[$field] = $this->$field;
            }
        }
        return $attribute;
    }

}
