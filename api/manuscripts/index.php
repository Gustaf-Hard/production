<? require_once ('../../includes/classes/AllClasses.php');



$lessons = array();


$result = $db->query("SELECT * FROM production_manuscript");


foreach($result as $lesson){
    //var_dump($lesson);
    $lessons[] = $lesson;
}

echo json_encode($lessons);
