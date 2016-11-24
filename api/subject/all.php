<? require_once ('../../includes/classes/AllClasses.php');


$lessons = array();



if(isset($_GET['subject_code'])){
    echo json_encode(Subject::findByCode($_GET['subject_code']));
}

$result = $db->query("SELECT *

FROM subject");


foreach($result as $lesson){
//var_dump($lesson);
$lessons[] = $lesson;
}

echo json_encode($lessons);