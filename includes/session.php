<?php
class Session {
    private $loggedIn = false;   //More important
    public $userId;

    function __construct(){
        session_start();
        $this->checkLogin();
        if($this->loggedIn){

        }else{

        }
    }

    public function isLoggedIn(){
        return $this->loggedIn;
    }

    public function login($user){
        // database should fine user based on username/password
        if($user){
            $this->userId = $_SESSION['userId'] = $user->id;
            $this->loggedIn = true;
        }
    }

    public function logout(){
        unset($_SESSION['userId']);
        unset($this->userId);
        $this->loggedIn = false;
    }

    private function checkLogin(){
        if(isset($_SESSION['userId'])){
            $this->userId = $_SESSION['userId'];
            $this->loggedIn = true;
        }else{
            unset($this->userId);
            $this->loggedIn = false;
        }
    }
}

$session = new Session();

?>