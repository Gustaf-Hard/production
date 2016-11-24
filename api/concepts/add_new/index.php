<?
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once ('../../../includes/classes/AllClasses.php');


$now = strftime("%Y-%m-%d %H-%M-%S", time());


// Add lesson
$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data

// validate the variables ======================================================
// if any of these variables don't exist, add_new an error to our $errors array

if(isset($_POST['lesson_id'])){
    $file = file_get_contents('http://mediagraf.se/official/api/lessons/uploaded/?lesson_id=' . $_POST['lesson_id']);
    $lesson = json_decode($file)[0];
    $subject = Subject::findByCode($lesson->subject_code);
    if(!is_object($subject)){
        $errors['subject'] = 'The subject do not exist and has to be added by an admin before.';
        if(isset($lesson->subject_code) && !empty($lesson->subject_code)){
            $errors['subject'] .= ' <strong>[' . $lesson->subject_code . ']</strong>';
        }
    }
} else {
    $errors['lesson_id'] = 'The lesson id is not set';
}


// return a response ===========================================================

// if there are any errors in our errors array, return a success boolean of false
if ( ! empty($errors)) {
    // if there are items in our errors array, return those errors
    $data['success'] = false;
    $data['errors']  = $errors;
} else {

    $file = file_get_contents('http://mediagraf.se/official/api/lessons/uploaded/?lesson_id=' . $_POST['lesson_id']);
    $lesson = json_decode($file)[0];
    $subject = Subject::findByCode($lesson->subject_code);

    //var_dump($_POST['subject_specific']);



    $concepts = explode(',', $_POST['all_concepts']);

    foreach ($concepts as $concept){
        $subject_specific = in_array($concept, $_POST['subject_specific']) ? true : false;
        /***************************************
         * 
         *  ADD ALL concepts and link to lesson
         */
        if(!Concept::findByConceptNameSubjectId(utf8_decode($concept), $subject_specific ? $subject->id : NULL)){
            $c = new Concept();
            $c->concept = utf8_decode($concept);
            $subject_specific
                ? $c->subject_id = $subject->id
                : NULL;
            $c->added_by = $_SESSION['user_id'];
            $c->created_at = $now;
            $c->updated_at = $now;
            if ($c->save()){
                $data['concepts_added'][] = $concept;
            }
            $data['success'] = true;
        } else {
            $data['concepts_not_added'][] = $concept;
        }

        $c = Concept::findByConceptNameSubjectId(utf8_decode($concept), $subject_specific ? $subject->id : NULL);
        if(!ConceptsLesson::findByConceptIdLessonId($c->id, $_POST['lesson_id'])){
            $cl = new ConceptsLesson();
            $cl->concept_id = $c->id;
            $cl->lesson_id = $_POST['lesson_id'];
            if ($cl->save()) {
                $data['concepts_lesson'][] = $concept;
            }
            $data['success'] = true;
        } else {
            $data['concepts_lesson_not_added'][] = $concept;
        }
    }


    // if there are no errors process our form, then return a message

    // show a message of success and provide a true success variable
    $data['created_at'] = $now;
    $data['lesson_id'] = $_POST['lesson_id'];
}

// return all our data to an AJAX call
echo json_encode($data);

