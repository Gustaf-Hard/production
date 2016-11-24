<?php



require_once("Database.php");
require_once("Session.php");



class Country extends DatabaseObject{
    static $table_name = "country";
    static $db_fields = array('id', 'code','country_name', 'native_name', 'added_by', 'created_at', 'updated_at');

    public $id;
    public $code;
    public $country_name;
    public $native_name;
    public $added_by;
    public $created_at;
    public $updated_at;



    public static function find_by_code($code){
        $result_set = static::find_by_sql("SELECT * FROM " . static::$table_name . " WHERE code LIKE '{$code}'");
        return !empty($result_set) ? array_shift($result_set) : false;
    }
}