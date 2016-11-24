<? require_once ('../../includes/classes/AllClasses.php');


$languages = array();





$result = $db->query("SELECT *
FROM language");


foreach($result as $language){
//var_dump($lesson);
    $languages[] = $language;
}




echo json_encode($languages);