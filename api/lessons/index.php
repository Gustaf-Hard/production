<? require_once ('../../includes/classes/AllClasses.php');


/*
echo isset($_GET['lesson_id'])
    ? json_encode(Lesson::find_by_id($_GET['lesson_id']))
    : json_encode(Lesson::find_all());
*/


echo file_get_contents('http://mediagraf.se/official/api/lessons/');
