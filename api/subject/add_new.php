<?php




// process.php
require_once ('../../includes/classes/AllClasses.php');


$now = strftime("%Y-%m-%d %H-%M-%S", time());



// Add lesson
$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data

// validate the variables ======================================================
// if any of these variables don't exist, add_new an error to our $errors array

if (empty($_POST['subject_name']))
    $errors['subject_name'] = 'Add a name';

if (empty($_POST['subject_code']))
    $errors['subject_code'] = 'Missing swedish subject code';

if (isset($_POST['subject_code']) && strlen($_POST['subject_code']) !== 3)
    $errors['subject_code'] = 'Code must be 3 characters';

if (empty($_POST['subject_int_code']))
    $errors['subject_int_code'] = 'Missing international subject code';

if (isset($_POST['subject_int_code']) && strlen($_POST['subject_int_code']) !== 3)
    $errors['subject_int_code'] = 'Code must be 3 characters';



// return a response ===========================================================

// if there are any errors in our errors array, return a success boolean of false
if ( ! empty($errors)) {

    // if there are items in our errors array, return those errors
    $data['success'] = false;
    $data['errors']  = $errors;
} else {

    // if there are no errors process our form, then return a message

    // DO ALL YOUR FORM PROCESSING HERE

    $lesson = new Subject();
    $lesson->subject_name= $_POST['subject_name'];
    $lesson->subject_code = strtoupper($_POST['subject_code']);
    $lesson->subject_int_code = strtoupper($_POST['subject_int_code']);
    $lesson->added_by = $_SESSION['user_id'];
    $lesson->created_at = $now;
    $lesson->updated_at = $now;
    $lesson->save();

    // show a message of success and provide a true success variable
    $data['success'] = true;
    $data['message'] = $_POST['subject_name'] . ' was added!';
    $data['subject_name'] = $_POST['subject_name'];

    $data['created_at'] = $now;

}

// return all our data to an AJAX call
echo json_encode($data);

