<?php




// process.php
require_once ('../layouts/app_header.php');


$now = strftime("%Y-%m-%d %H-%M-%S", time());



// Add lesson
$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data

// validate the variables ======================================================
// if any of these variables don't exist, add_new an error to our $errors array

if (empty($_POST['manuscript_url']))
    $errors['manuscript_url'] = 'No url is added';

if (empty($_POST['manuscript_text']))
    $errors['manuscript_text'] = 'Add the manuscript text';

// return a response ===========================================================

// if there are any errors in our errors array, return a success boolean of false
if ( ! empty($errors)) {

    // if there are items in our errors array, return those errors
    $data['success'] = false;
    $data['errors']  = $errors;
} else {

    // if there are no errors process our form, then return a message

    // DO ALL YOUR FORM PROCESSING HERE

    $lesson = new Manuscript();
    $lesson->manuscript_url= $_POST['manuscript_url'];
    $lesson->manuscript_text = $_POST['manuscript_text'];
    $lesson->localized_for = $_POST['localized_for'];
    $lesson->lesson_id = $_POST['lesson_id'];
    $lesson->added_by = $_SESSION['user_id'];
    $lesson->created_at = $now;
    $lesson->updated_at = $now;
    $lesson->save();

    $lesson = Lesson::find_by_id($_POST['lesson_id']);
    // show a message of success and provide a true success variable
    $data['success'] = true;
    $data['message'] = 'Manuscript was added to [' . $lesson->getFullCode() . '] ' . $lesson->lesson_name;
    $data['lesson_id'] = $_POST['lesson_id'];


}

// return all our data to an AJAX call
echo json_encode($data);

