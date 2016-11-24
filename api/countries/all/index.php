<?php
$file = file_get_contents('https://restcountries.eu/rest/v1/all');

if(isset($_GET['code'])){
    $countries = json_decode($file);
    foreach ($countries as $country){
        if(strtoupper($_GET['code']) == $country->alpha2Code){
            echo json_encode($country);
        }
    }
} else{
    echo $file;
}

