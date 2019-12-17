<?php
require_once(LIB_PATH.DS."initialize.php");

class mySQLDatabase {
    private $connection;
    private $lastQuery;
    private $maginQuotesActive;
    private $realEscapeStringExists;
   

    function __construct(){
        $this->maginQuotesActive = get_magic_quotes_gpc();
        $this->realEscapeStringExists = function_exists("mysqli_real_escape_string");
        $this->openConnection();
    }

    public function openConnection() {
        $this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        if (mysqli_connect_errno()) {
            die("Database connection failed: " .
                    mysqli_connect_error() .
                    " (" . mysqli_connect_errno() . ")"
            );
        }
    }

    public function closeConnection(){
        if(isset($this->connection)){
            mysqli_close($this->connection);
            unset($this->connection);
        }
    }

    public function query($sql){
        $this->lastQuery = $sql;
        $result = mysqli_query($this->connection, $sql);
        $this->confirmQuery($result);
        return $result;
    }

    public function escapeValue($value){
        
        if($this->realEscapeStringExists){
            //undo any magic quote effects so mysql_real_escape_string can do the work
            if($this->maginQuotesActive){
                $value = stripslashes($value);
            }
            $value = mysqli_real_escape_string($this->connection,$value);
        }else{ //before PHP 4.3.0
            // if magic quotes aren`t already on the addslashes manually
            if(!$this->maginQuotesActive){
                $value = addslashes($value);
            }
            //if magic quates are active, then the slashes already exist
        }
        return $value;
    }

    // "database-neutral" methods
    public function fetchAssoc($result_set) {
        return mysqli_fetch_assoc($result_set);
    }

    public function numRows($resultSet) {
        return mysqli_num_rows($resultSet);
    }

    public function insertId() {
        // get the last id inserted over the current db connection
        return mysqli_insert_id($this->connection);
    }

    public function affectedRows() {
        return mysqli_affected_rows($this->connection);
    }

    private function confirmQuery($result){
        if(!$result){
            // die("Database query failed: ".mysqli_error());
            $output = "Database query failed!";
            mysqli_connect_error()."<br /><br />";
            $output .= " Last SQL query: ". $this->lastQuery;
            die($output);
        }
    }
    
}

$database = new MySQLDatabase();
// $database->closeConnection();
$db = & $database;  // refrence