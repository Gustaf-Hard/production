<? require_once ('../../../includes/classes/AllClasses.php');

$concepts = array();
$result = $db->query("

SELECT concepts.id, concepts.concept, concepts.added_by, IFNULL(subject.subject_name,\"Not subject specific\") as subject_name 
FROM concepts
LEFT JOIN subject
ON concepts.subject_id=subject.id
WHERE concepts.explanation IS NULL

");
foreach($result as $item){
    $concepts[] = $item;
}


echo json_encode($concepts);


