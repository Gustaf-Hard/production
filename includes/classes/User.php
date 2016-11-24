<?php



require_once("Database.php");
require_once("Session.php");



class User extends DatabaseObject{
    static $table_name = "users";
    static $db_fields = array('id', 'name','user_name', 'password', 'last_seen');

    public $id;
    public $name;
    public $user_name;
    public $password;
    public $last_seen;


    public function CheckAdmin(){
        return UserRole::CheckRoleForUser($this->id, 1);
    }

    public function FullName(){
        return $this->name;
    }

    private static function Authenticate($user_name="", $password=""){
        $db = new Database();
        $user_name = $db->mysql_prep($user_name);
        $password = $db->mysql_prep($password);

        $user = self::GetUserByUsername($user_name);

        if($user){
            return static::CheckPassword($password, $user->password) ?
                $user : false;
        } else {
            return false;
        }

    }


    // Check password for login
    private static function CheckPassword($password, $existing_hash) {
        // existing hash contains format and salt at start
        $hash = crypt($password, $existing_hash);
        return $hash === $existing_hash ? true : false;
    }

    public static function GetUserByEmail($email){
        $result_array = static::find_by_sql("
                              SELECT * FROM users 
                              WHERE email = '{$email}' 
                              LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public static function GetUserByUsername($username){
        $content = file_get_contents('http://mediagraf.se/official/api/users/?user_name=' . $username);
        $c = json_decode($content);

        return isset($c[0]) ? $c[0] : false;
    }


    public static function AttemptToLogIn($user_name, $password){
        $user_name = trim($user_name);
        $password = trim($password);
        $found_user = static::Authenticate($user_name, $password);
        if($found_user) {
            $session = new Session();
            $db = new Database();
            $session->login($found_user);
            $db->redirect_to('index.php');
        } else {
            $_SESSION['message'] = array("Username/Password did not match", "danger");
        }
    }


    //Encrypt the password and decrypt the password
    public static function password_encrypt($password) {
        $hash_format = "$2y$10$";	 // Tells PHP to use Bluefish with a "cost" of 10 or more
        $salt_length = 22;			// Blowfish salt should be 22-characters or more
        $salt = static::generateSalt($salt_length);
        $format_and_salt = $hash_format . $salt;
        $hash = crypt($password, $format_and_salt);
        return $hash;
    }

    //Generate a salt for hashing passwords
    private static function generateSalt($length) {
        // Not 100% unique, not 100% random, but good enough
        // MD5 returns 32 characters
        $unique_random_string = md5(uniqid(mt_rand(), true));

        // Valid characters for a salt are [a-zA-Z0-9./]
        $base64_string = base64_encode($unique_random_string);

        // But not '+' which is valid in base 64 encoding
        $modified_base64_string = str_replace('+', '.', $base64_string);

        // Truncate string to the correct length
        $salt = substr($modified_base64_string, 0, $length);

        return $salt;
    }


}