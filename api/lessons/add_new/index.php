<?php


// process.php
require_once ('../../../includes/classes/AllClasses.php');

$now = strftime("%Y-%m-%d %H-%M-%S", time());


// Add lesson
$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data

// validate the variables ======================================================
// if any of these variables don't exist, add_new an error to our $errors array



// Need to selct a country. 
if (empty($_POST['language']))
    $errors['language'] = 'You have to select a language first';

// Check so that there is no doublicate countries
if(isset($_POST['language']) && Language::find_by_code($_POST['language']))
    $errors['language'] = 'That country is already added';


// return a response ===========================================================

// if there are any errors in our errors array, return a success boolean of false
if ( ! empty($errors)) {
    // if there are items in our errors array, return those errors
    $data['success'] = false;
    $data['errors']  = $errors;
} else {

    // if there are no errors process our form, then return a message

    // DO ALL YOUR FORM PROCESSING HERE
    $content = file_get_contents('http://' . getenv('HTTP_HOST') . ROOT. 'api/languages/all/?code=' . $_POST["language"]);
    $c = json_decode($content);

    $language = new Language();
    $language->language_name= $c->name;
    $language->code = $c->code;
    $language->native_name = $c->nativeName;
    $language->added_by = $_SESSION['user_id'];
    $language->created_at = $now;
    $language->updated_at = $now;
    $language->save();

    // show a message of success and provide a true success variable
    $data['success'] = true;
    $data['message'] = $c->name . ' was added!';
    $data['language_name'] = $c->name;

    $data['created_at'] = $now;

}

// return all our data to an AJAX call
echo json_encode($data);

