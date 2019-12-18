<?php
require_once(LIB_PATH.DS.'database.php');

class databaseObject
{
    protected static $tableName = 'users' ;
    protected static $dbFields;

public static function findAll(){
        return static::findBySql("SELECT * FROM " . static::$tableName);
    }

    public static function findById($id = 0){
        $resultArray = static::findBySql("SELECT * FROM " . static::$tableName . " WHERE id = {$id} LIMIT 1");
        return !empty($resultArray) ? array_shift($resultArray) : false;
    }

    private static function instantiate($record){
        // Could check that $record exists and us an array
        //Simple, long form approch;
        $className = get_called_class();
        $object    = new $className;
        // $object->id        = $record['id'];
        // $object->username  = $record['username'];
        // $object->password  = $record['passwrod'];
        // $object->firstName = $record['firstName'];
        // $object->lastName  = $record['lastName'];

        //More dynamic shot-form approch:

        foreach($record as $attribute=>$value){
            if($object->hasAttribute($attribute)){
                $object->$attribute = $value;
            }
        }

        return $object;
    }

    public static function findBySql($sql = ""){
        global $database;
        $resultSet = $database->query($sql);
        $objectArray = array();
        while($row = $database->fetchAssoc($resultSet)){
            $objectArray[] = static::instantiate($row);
        }
        return $objectArray;
    }

    private function hasAttribute($attribute){
        $objectVars = $this->attribute();
        return array_key_exists($attribute, $objectVars);
    }

    protected function attribute(){
        $attribute = array();
        foreach (static::$dbFields as $field){
            if(property_exists($this, $field)){
                $attribute[$field] = $this->$field;
            }
        }
        return $attribute;
    }

    protected function sanitizedAttribute(){
        global $database;
        $cleanAttributes = array();
        foreach ($this->attribute() as $key => $value){
            $cleanAttributes[$key] = $database->escapeValue($value);
        }
        return $cleanAttributes;
    }

    public function save(){
        return isset($this->id) ? $this->update() : $this->create();
    }

    protected function create(){
        global $database;
        $attribute = $this->sanitizedAttribute();

        $sql  = "INSERT INTO ".static::$tableName." (";
//        $sql .= "username, password, firstName, lastName ";
        $sql .= join(", ", array_keys($attribute));
        $sql .= ") VALUES ('";
        $sql .= join("', '" , array_values($attribute));
        $sql .= "');";
//        $sql .= $database->escapeValue($this->username) . "', '";
//        $sql .= $database->escapeValue($this->password) . "', '";
//        $sql .= $database->escapeValue($this->firstName) . "', '";
//        $sql .= $database->escapeValue($this->lastName) . "')";

        if($database->query($sql)){
            $this->id = $database->insertId();
            return true;
        }else{
            return false;
        }
    }

    protected function update(){
        global $database;
        $attribute = $this->sanitizedAttribute();
        $attributePairs = array();
        foreach ($attribute as $key => $value){
            $attributePairs[] = "{$key} = '{$value}'";
        }

        $sql  = "UPDATE ".static::$tableName." SET ";
        $sql .= join(", " , $attributePairs);
//        $sql .= "username='" . $database->escapeValue($this->username) ."', ";
//        $sql .= "password='" . $database->escapeValue($this->password) ."', ";
//        $sql .= "firstName='" . $database->escapeValue($this->firstName) ."', ";
//        $sql .= "lastName='" . $database->escapeValue($this->lastName) ."' ";
        $sql .= " WHERE id=" . $database->escapeValue($this->id) ;
        $database->query($sql);

        return ($database->affectedRows() == 1) ? true : false;
    }

    public function delete(){
        global $database;

        $sql  = "DELETE FROM ".static::$tableName." ";
        $sql .= "WHERE id=" . $database->escapeValue($this->id);
        $sql .= " LIMIT 1";
        $database->query($sql);
        return ($database->affectedRows() == 1 ) ? true : false;

    }

}
