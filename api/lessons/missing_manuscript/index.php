<? require_once ('../../../includes/classes/AllClasses.php');


$lessons = array();


// all lessons
$lesson_result = json_decode(file_get_contents('http://localhost:8888/studi_production/api/lessons/'));

// all manuscripts
$manuscript_result = json_decode(file_get_contents('http://localhost:8888/production/api/manuscripts/'));


foreach ($lesson_result as $lesson){
    $match = 0;
    foreach ($manuscript_result as $manuscript){
        if($lesson->id == $manuscript->lesson_id){
            $match = 1;
        }
    }
    if($match == 0)
    $lessons[] = $lesson;
}

echo json_encode($lessons);




