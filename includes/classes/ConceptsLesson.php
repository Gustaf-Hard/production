<?php





class ConceptsLesson extends DatabaseObject
{
    static $table_name = "concepts_lesson";
    static $db_fields = array('id', 'concept_id', 'lesson_id', 'added_by', 'created_at', 'updated_at');

    public $id;
    public $concept_id;
    public $lesson_id;
    public $added_by;
    public $created_at;
    public $updated_at;


    public static function findByConceptIdLessonId($concept_id, $lesson_id){
        
        
        $result_array = static::find_by_sql("SELECT id, concept_id FROM " . static::$table_name . " WHERE concept_id = '{$concept_id}' AND lesson_id = '{$lesson_id}'");
        return !empty($result_array) ? array_shift($result_array) : false;
    }


}