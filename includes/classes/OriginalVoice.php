<?php



class OriginalVoice extends DatabaseObject{
    static $table_name = "production_voice";
    static $db_fields = array('id', 'lesson_id', 'voice_url', 'language_id', 'file_name', 'added_by', 'created_at', 'updated_at');

    public $id;
    public $lesson_id;
    public $voice_url;
    public $language_id;
    public $file_name;
    public $added_by;
    public $created_at;
    public $updated_at;



    public static function findLessonsMissingVoice(){
        return Lesson::find_by_sql("SELECT * FROM lesson_lesson 
                              WHERE id IN
                              (SELECT lesson_id FROM production_manuscript )
                              AND id NOT IN
                              (SELECT lesson_id FROM " . static::$table_name . " ) ORDER BY created_at DESC");

    }


}

