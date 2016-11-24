<?php



require_once("Database.php");
require_once("Session.php");



class UserPermission extends DatabaseObject{
    static $table_name = "user_permission";
    static $db_fields = array('id', 'user_id', 'municipality_id', 'school_id','app_id','admin', 'created_at', 'updated_at');

    public $id;
    public $user_id;
    public $municipality_id;
    public $school_id;
    public $app_id;
    public $admin;
    public $created_at;
    public $updated_at;
    

    public static function Check($workflow_id, $user_id){
        $result_array = static::find_by_sql("SELECT * FROM " . static::$table_name . " 
                                    WHERE 
                                    workflow_id = '{$workflow_id}' AND 
                                    user_id = '{$user_id}' ");
        if(!empty($result_array)){
            return true;
        } else{
            $workflow = Workflow::find_by_id($workflow_id);
            $result_array = static::find_by_sql("SELECT * FROM " . static::$table_name . " 
                                    WHERE 
                                    area = '{$workflow->area}' AND
                                    workflow_id IS NULL AND 
                                    user_id = '{$user_id}' ");
            return !empty($result_array) ? true : false;
        }
    }

    public static function CheckFullAreaPermission($area_name, $user_id){
        $result_array = static::find_by_sql("SELECT * FROM " . static::$table_name . " 
                                    WHERE   
                                    area = '{$area_name}' AND
                                    workflow_id IS NULL AND
                                    user_id = '{$user_id}' ");
        return !empty($result_array) ? true : false;
    }


    public static function CheckAreaPermission($area){
        $user_id = $_SESSION['user_id'];
        $result_array = static::find_by_sql("SELECT * FROM " . static::$table_name . " 
                                    WHERE   
                                    area = '{$area}' AND  
                                    user_id = '{$user_id}' ");
        return !empty($result_array) ? true : false;
    }


    public static function DeletePermissionByUserId($user_id){
        $db = new Database();
        $db->query("DELETE FROM `user_permission` WHERE user_id = {$user_id}");
    }



}