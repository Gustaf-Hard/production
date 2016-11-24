<? require_once ('../../includes/classes/AllClasses.php');


$concepts = array();

if(isset($_GET['subject_id'])){
    $concepts_lesson = $db->query("
        SELECT concepts.id, concepts.concept, concepts.added_by, IFNULL(subject.subject_name,\"Not subject specific\") as subject_name FROM concepts

        LEFT JOIN subject
        ON concepts.subject_id=subject.id
        WHERE concepts.subject_id = {$_GET['subject_id']}

        GROUP BY concepts.concept"
    );


    foreach($concepts_lesson as $item){
        $concepts[] = $item;
    }
    echo json_encode($concepts);

} elseif(isset($_GET['concept'])){

    $concepts_lesson = $db->query("SELECT concepts.*, subject.subject_name FROM `concepts` 
        LEFT JOIN subject
        ON concepts.subject_id=subject.id
        WHERE concepts.concept LIKE '{$db->mysql_prep($_GET['concept'])}'");


    foreach($concepts_lesson as $item){
        $concepts[] = $item;
    }

    echo json_encode($concepts);
} elseif(isset($_GET['concept_id'])){
    $concept = Concept::find_by_id($_GET['concept_id']);
    if($concept){
        $concepts_lesson = $db->query("
        SELECT concepts.*, subject.subject_name FROM concepts  
        LEFT JOIN subject 
        ON concepts.subject_id=subject.id 
        WHERE concepts.concept LIKE '{$concept->concept}' 
        AND concepts.id != {$concept->id}");

        foreach($concepts_lesson as $item){
            $concepts[] = $item;
        }

        echo json_encode($concepts);
    }

}



else {
    $concepts = array();
    $result = $db->query("
        SELECT concepts.id, concepts.concept, concepts.added_by, IFNULL(subject.subject_name,\"Not subject specific\") as subject_name FROM concepts
        
        LEFT JOIN (SELECT * FROM concepts_lesson WHERE subject_id IS NOT NULL) as lessons
        ON concepts.id=lessons.concept_id
        
        LEFT JOIN subject
        ON lessons.subject_id=subject.id
        
        GROUP BY concepts.concept
    ");
    foreach($result as $item){
        $concepts[] = $item;
    }


    echo json_encode($concepts);
}
