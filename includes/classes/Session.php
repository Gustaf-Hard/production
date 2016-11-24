<?php


require_once("Database.php");



class Session {

    private $logged_in=false;
    public $user_id;

    function __construct(){
        if(!isset($_SESSION)) {
            session_start();
        }

        $this->check_login();
        if($this->logged_in){
            // TODO: Add userlogging last login and so on here
        } else {
            // TODO: Redirect to the login page.
        }
    }

    public function is_logged_in(){
        return $this->logged_in;
    }

    public function logout(){
        unset($_SESSION['user_id']);
        unset($this->user_id);
        $this->logged_in = false;

    }

    public function login($user){
        // Database should find the user by username/password
        if($user){
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $_SESSION['user_id'] = $user->id;
            $_SESSION["username"] = $user->user_name;
            $_SESSION["name"] = $user->name;
            $this->logged_in = true;

        }
    }

    private function check_login(){
        if(isset($_SESSION['user_id'])){
            $this->user_id = $_SESSION['user_id'];
            $this->logged_in = true;
        } else {
            unset($this->user_id);
            $this->logged_in = false;
        }
    }

    public static function Message() {
        if(isset($_SESSION['message'])) {
            if(!is_array($_SESSION['message'])){
                $_SESSION['message'] = array($_SESSION['message'], 'success');
            }
            if (isset($_SESSION['message'][0])){
                // success, info, warning, danger
                $output = "<div class=\"alert alert-{$_SESSION['message'][1]}\" role=\"alert\">";
                $output .= $_SESSION["message"][0];
                $output .= "</div>";

                //Clear messages after use
                $_SESSION["message"] = null;

                echo $output;
            }
        }

    }


}



$session = new Session();