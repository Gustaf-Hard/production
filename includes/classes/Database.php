<?php
class Database{
    public $connection;

    function __construct(){

        $this->open_connection();
    }

    public function open_connection(){

        //1. Create a database connection
        $this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

        // Test if caonnection succeeded
        if(mysqli_connect_errno()){
            die("Database connection failed: " .
                mysqli_connect_error() .
                " (" . mysqli_connect_errno() . ")"
            );
        }
    }

    public function close_connection(){
        if(isset($connection)){
            mysqli_close($connection);
            unset($connection);
        }
    }


    public function query($sql) {
        $result_set = mysqli_query($this->connection, $sql);
        $this->confirm_query($result_set);
        return $result_set;
    }

    private function confirm_query($result_set) {
        if (!$result_set)
            if (mysqli_connect_errno())
                die("Failed to connect to MySQL: " . mysqli_connect_error());
    }

    public function mysql_prep($string){
        $escape_string = mysqli_real_escape_string($this->connection, $string);
        return $escape_string;
    }

    public function redirect_to($new_location) {
        ob_start();
        error_reporting(E_ALL);
        ini_set('display_errors', 'On');
        header("Location:{$new_location}");
        ob_flush();
        exit;
    }

    public function NumRowsQuery($sql){
        return mysqli_num_rows($this->query($sql));
    }

    public function FetchQuery($sql){
        return mysqli_fetch_array($this->query($sql));
    }

    public function fetch_array($result_set){
        return mysqli_fetch_array($result_set);
    }

    // Retrns the id of last added row.
    public function insert_id(){

        return mysqli_insert_id($this->connection);
    }

    public function affected_rows(){
        return mysqli_affected_rows($this->connection);
    }

    public static function RemoveBS($Str) {
        $StrArr = str_split($Str);
        $NewStr = '';
        foreach ($StrArr as $Char) {
            $CharNo = ord($Char);
            if ($CharNo == 163) { $NewStr .= $Char; continue; } // keep £
            if ($CharNo >= 192 && $CharNo <= 255 ) { $NewStr .= $Char; continue; } // keep ÅÄÖ and so on
            if ($CharNo > 31 && $CharNo < 127) {
                $NewStr .= $Char;
            }
        }
        //$NewStr = rtrim($NewStr); // Remove last line break and spaces if ther is any.
        
        return $NewStr;
    }

    function return_checked_if_done_by_db($database, $column_name, $lesson_id){
        $lesson = SwedenLesson::find_by_id($database, $lesson_id);
        if($lesson->{$column_name} == 1){
            echo "checked=\"checked\"";
        } else {
            echo "";
        }
    }


    public static function getColumnType($table_name, $column_name){
        $database = New Database();
        $info_set = $database->query("describe {$table_name} {$column_name}");
        $info = mysqli_fetch_assoc($info_set);
        return $info['Type'];
    }
    
    
    
    

}

$database = new Database();