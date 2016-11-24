<?php



class Lesson extends DatabaseObject
{
    static $table_name = "lesson_lesson";
    static $db_fields = array('id', 'subject_code', 'lesson_number', 'lesson_name', 'added_by', 'created_at', 'updated_at');

    public $id;
    public $subject_code;
    public $lesson_number;
    public $lesson_name;
    public $added_by;
    public $created_at;
    public $updated_at;


    public static function findByProductionCode($subject_code, $lesson_number)
    {
        $result_array = static::find_by_sql("SELECT lesson_name FROM " . static::$table_name .
            " WHERE subject_code LIKE '{$subject_code}' AND lesson_number LIKE '{$lesson_number}' ");

        return !empty($result_array) ? array_shift($result_array) : false;

    }

    public function getFullCode(){
        return $this->subject_code . $this->lesson_number;
    }
}