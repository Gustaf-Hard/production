<? require_once ('../../../includes/classes/AllClasses.php');


$lessons = array();


// all lessons
$lesson_result = json_decode(file_get_contents('http://mediagraf.se/official/api/lessons/uploaded/'));

// all manuscripts
$concept_result = $db->query("SELECT * FROM concepts_lesson GROUP BY lesson_id");

foreach ($lesson_result as $lesson){
    $match = 0;
    foreach ($concept_result as $concept){
        if($lesson->id == $concept['lesson_id']){
            $match = 1;
        }
    }
    if($match == 0)
    $lessons[] = $lesson;
}

echo json_encode($lessons);




