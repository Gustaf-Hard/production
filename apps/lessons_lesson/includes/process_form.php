<?php




// process.php
require_once ('layouts/app_header.php');


$now = strftime("%Y-%m-%d %H-%M-%S", time());



// Add lesson
$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data

// validate the variables ======================================================
// if any of these variables don't exist, add_new an error to our $errors array

if (empty($_POST['lesson_subject']))
    $errors['lesson_subject'] = 'Missing Subject';

if (empty($_POST['lesson_number']))
    $errors['lesson_number'] = 'It needs a lesson number';

if (isset($_POST['lesson_number']) && strlen($_POST['lesson_number'])  !== 3)
    $errors['lesson_number'] = 'Need to be 3 numbers';

if (isset($_POST['lesson_subject']) && isset($_POST['lesson_number']) && Lesson::findByProductionCode($_POST['lesson_subject'], $_POST['lesson_number']))
    $errors['lesson_number2'] = 'That number already in use';

if (empty($_POST['lesson_name']))
    $errors['lesson_name'] = 'Select an english name for the lesson';

// return a response ===========================================================

// if there are any errors in our errors array, return a success boolean of false
if ( ! empty($errors)) {

    // if there are items in our errors array, return those errors
    $data['success'] = false;
    $data['errors']  = $errors;
} else {

    // if there are no errors process our form, then return a message

    // DO ALL YOUR FORM PROCESSING HERE

    $lesson = new Lesson();
    $lesson->subject_code= $_POST['lesson_subject'];
    $lesson->lesson_number = $_POST['lesson_number'];
    $lesson->lesson_name = $_POST['lesson_name'];
    $lesson->added_by = $_SESSION['user_id'];
    $lesson->created_at = $now;
    $lesson->updated_at = $now;
    $lesson->save();

    // show a message of success and provide a true success variable
    $data['success'] = true;
    $data['message'] = 'Lesson was added!';
    $data['subject_code'] = $_POST['lesson_subject'];
    $data['lesson_number'] = $_POST['lesson_number'];
    $data['lesson_name'] = $_POST['lesson_name'];
    $data['created_at'] = $now;

}

// return all our data to an AJAX call
echo json_encode($data);

