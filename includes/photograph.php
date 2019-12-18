<?php
// require_once(LIB_PATH.DS.'databaseObject.php');
require_once(LIB_PATH.DS.'database.php');

class PhotoGraphs extends databaseObject {
    protected static $tableName = "photographs";
    protected static $dbFields = array('id', 'filename', 'type', 'size', 'caption');
    public $id;
    public $filename;
    public $type;
    public $size;
    public $caption;
    private  $tempPath;
    protected $uploadDir = "images";
    public $errors = array();
    protected $uploadError = array(
    UPLOAD_ERR_OK => "No errors.",
    UPLOAD_ERR_INI_SIZE => "Larger than upload_max_filesize.",
    UPLOAD_ERR_FORM_SIZE => "Larger than from MAX_FILE_SIZE.",
    UPLOAD_ERR_PARTIAL => "Partial upload.",
    UPLOAD_ERR_NO_FILE => "No file.",
    UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
    UPLOAD_ERR_CANT_WRITE => "Can`t write to disk.",
    UPLOAD_ERR_EXTENSION => "File upload stopped by extension."
    );

    //Pass in $_FILE(['uploadFile']) as an argument
    public function attachFile($file){
        //Perform error checking on the form parameters
        if(!$file || empty($file) || !is_array($file)){
            $this->errors[] = "No files was uploaded.";
            return false;
        }elseif($file ['error'] != 0){
            $this->errors[] = $this->uploadError[$file['error']];
            return false;
        } else {
            //Set object attribute to the form parameters.
            $this->tempPath = $file['tmp_name'];
            $this->filename = basename($file['name']);
            $this->type = $file['type'];
            $this->size = $file['size'];
            return true;
        }
    }

    public function save(){
        //A new record won`t have an id yet.
        if(isset($this->id)){
            //Really just to update the caption
            $this->update();
        }else{
            //Make sure there are no error
            //Can`t save if there are pre-existing error
            if(!empty($this->errors)){
                return false;
            }
            //Make sure the caption is not too long for the DB
            if(strlen($this->caption > 255)){
                $this->errors[] = "The caption can only be 255 characters long.";
                return false;
            }
            //Can`t save without filename and temp location
            if(empty($this->filename) || empty($this->tempPath)){
                $this->errors[] = "The file location was not available.";
                return false;
            }
            $targetPath = SITE_ROOT . DS . 'public' . DS . $this->uploadDir . DS . $this->filename;
            //Make sure a file dosen`t already exist in the target location
            if(file_exists($targetPath)){
                $this->errors[] = "the file {$this->filename} already exists.";
                return false;
            }
            //Attempt to move the file
            if(move_uploaded_file($this->tempPath, $targetPath)){
                //Success
                //Save a corresponding entry to the database
                if($this->create()){
                    //We are done with temp_path, the file isn`t there anymore.
                    unset($this->tempPath);
                    return true;
                }
            }else{
                //File was not moved.
                $this->errors[] = "The file upload failed, possibly due to incorrect permission on the upload folder.";
                return false;
            }

        }
    }

    public function imagePath(){
        return $this->uploadDir . DS . $this->filename;
    }

    public function sizeAsText(){
        if($this->size < 1024){
            return "{$this->size} bytes;";
        }elseif ($this->size < 1048576){
            $sizeKB = round($this->size / 1024);
            return "{$sizeKB} KB";
        }else {
            $sizeMB = round($this->size / 1048576 , 1);
            return "{$sizeMB} MB"; 
        }
    }

    public static function findById($id = 0){
        global $database;
        $resultArray = self::findBySql("SELECT * FROM " . self::$tableName .
        " WHERE id=" . $database->escapeValue($id) . " LIMIT 1");
        return !empty($resultArray) ? array_shift($resultArray) : false;
    }

    public function destroy(){
        //First remove the database entry.
        if($this->delete()){
            $targetPath = SITE_ROOT . DS . 'public' . DS . $this->imagePath(); 
            return unlink($targetPath) ? true : false; 

        } else {
            //database delete failed.
            return false;
        }
    }

    public function comments(){
        return Comment::findCommentOn($this->id); 
    }
}

