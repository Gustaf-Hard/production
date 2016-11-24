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
if (empty($_POST['country']))
    $errors['country'] = 'You have to select a country';

// Check so that there is no doublicate countries
if(isset($_POST['country']) && Country::find_by_code($_POST['country']))
    $errors['country'] = 'That country is already added';


// return a response ===========================================================

// if there are any errors in our errors array, return a success boolean of false
if ( ! empty($errors)) {
    // if there are items in our errors array, return those errors
    $data['success'] = false;
    $data['errors']  = $errors;
} else {

    // if there are no errors process our form, then return a message

    // DO ALL YOUR FORM PROCESSING HERE
    $content = file_get_contents('http://' . getenv('HTTP_HOST') . ROOT. 'api/countries/all/?code=' . $_POST["country"]);
    $c = json_decode($content);

    $country = new Country();
    $country->country_name= $c->name;
    $country->code = $c->alpha2Code;
    $country->native_name = $c->nativeName;
    $country->added_by = $_SESSION['user_id'];
    $country->created_at = $now;
    $country->updated_at = $now;
    $country->save();

    // show a message of success and provide a true success variable
    $data['success'] = true;
    $data['message'] = $c->name . ' was added!';
    $data['country_name'] = $c->name;

    $data['created_at'] = $now;

}

// return all our data to an AJAX call
echo json_encode($data);

