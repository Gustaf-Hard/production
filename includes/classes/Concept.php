<?php





class Concept extends DatabaseObject
{
    static $table_name = "concepts";
    static $db_fields = array('id', 'subject_id', 'concept', 'inflection', 'synonyms', 'explanation', 'img_url', 'added_by', 'created_at', 'updated_at');

    public $id;
    public $subject_id;
    public $concept;
    public $inflection;
    public $synonyms;
    public $explanation;
    public $img_url;
    public $added_by;
    public $created_at;
    public $updated_at;


    public static function findByConceptNameSubjectId($concept, $subject_id=""){
        $db = New Database();

        $query = "SELECT id, concept FROM " . static::$table_name . " WHERE concept LIKE '{$db->mysql_prep($concept)}' ";
        $query .= isset($subject_id) && !empty($subject_id)
            ? " AND subject_id = '{$subject_id}' "
            : " AND subject_id IS NULL ";

        $result_array = static::find_by_sql($query);
        return !empty($result_array) ? array_shift($result_array) : false;
    }


    public static function findByConceptNameNOSubjectId($concept){
        $db = New Database();
        $result_array = static::find_by_sql("SELECT id, concept FROM " . static::$table_name . " WHERE concept LIKE '{$db->mysql_prep($concept)}'
        AND subject_id IS NULL ");
        return !empty($result_array) ? array_shift($result_array) : false;
    }


    public static function findByConceptname($concept){
        $db = New Database();
        return static::find_by_sql("
        SELECT concepts.*, subject.subject_name FROM `concepts` 
        LEFT JOIN subject
        ON concepts.subject_id=subject.id
        WHERE concepts.concept LIKE '{$db->mysql_prep($concept)}'");

    }


}