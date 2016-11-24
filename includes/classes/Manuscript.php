<?php



class Manuscript extends DatabaseObject{
    static $table_name = "production_manuscript";
    static $db_fields = array('id', 'lesson_id', 'manuscript_url', 'localized_for', 'manuscript_text', 'added_by', 'created_at', 'updated_at');

    public $id;
    public $lesson_id;
    public $manuscript_url;
    public $localized_for;
    public $manuscript_text;
    public $added_by;
    public $created_at;
    public $updated_at;
    public $lesson_name;




    public static function findLessonsMissingManuscript(){
        return Lesson::find_by_sql("SELECT * FROM lesson_lesson 
                              WHERE id NOT IN
                              (SELECT lesson_id FROM " . static::$table_name . " ) ORDER BY created_at DESC");

    }


    public static function findLessonsHavingManuscript(){
        return Manuscript::find_by_sql("SELECT * FROM " . static::$table_name. " 
                                        RIGHT JOIN lesson_lesson
                                        ON " . static::$table_name . ".lesson_id=lesson_lesson.id");

    }

}

