<?php



require_once("Database.php");
require_once("Session.php");



class Subject extends DatabaseObject{
    static $table_name = "subject";
    static $db_fields = array('id', 'subject_name','subject_code', 'subject_int_code', 'added_by', 'created_at', 'updated_at');

    public $id;
    public $subject_name;
    public $subject_code;
    public $subject_int_code;
    public $added_by;
    public $created_at;
    public $updated_at;



    public static function findByCode($subject_code){
        $result_set = static::find_by_sql("SELECT * FROM " . static::$table_name . " 
                                            WHERE subject_code LIKE '{$subject_code}' 
                                            OR subject_int_code LIKE '{$subject_code}' ");
        return !empty($result_set) ? array_shift($result_set) : false;

    }

}