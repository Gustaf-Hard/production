<?php
$file = file_get_contents('all_languages.php');

if(isset($_GET['code'])){
    $languages = json_decode($file);
    foreach ($languages as $key => $value){
        if(strtolower($_GET['code']) == $key){
            $output = ['code' => $key, 'name' => $value->name, 'nativeName' => $value->nativeName ];
            echo json_encode($output);
        }
    }
} else{
    echo $file;
}

