<? require_once ('../../../includes/classes/AllClasses.php');


$now = strftime("%Y-%m-%d %H-%M-%S", time());


// Add lesson
$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data

// validate the variables ======================================================
// if any of these variables don't exist, add_new an error to our $errors array



if( empty($_POST['explanation'])){
    $data['errors'] =  "Missing explanation";
}
// return a response ===========================================================

// if there are any errors in our errors array, return a success boolean of false
if ( ! empty($errors)) {
    // if there are items in our errors array, return those errors
    $data['success'] = false;
    $data['errors']  = $errors;

} else {
    $concept = Concept::find_by_id($_POST['concept_id']);
        $concept->explanation = $db->mysql_prep($_POST['explanation']);
        $concept->updated_at = $now;
        if(isset($_POST['inflections'])){
            $i = "";
            foreach ($_POST['inflections'] as $inflection){
                $i .= $inflection . ",";
            }
            $concept->inflection = $db->mysql_prep($i);
        }
        if(isset($_POST['synonyms'])){
            $s = "";
            foreach ($_POST['synonyms'] as $synonym){
                $s .= $synonym . ",";
            }
            $concept->synonyms = $db->mysql_prep($s);
        }

        if ($concept->save()){
            $data['message'] = "The concept <strong>" . $concept->concept ."</strong> was updated";
            $data['success'] = true;
        }

    // show a message of success and provide a true success variable
    $data['created_at'] = $now;
    $data['concept_id'] = $_POST['concept_id'];

}

// return all our data to an AJAX call
echo json_encode($data);

