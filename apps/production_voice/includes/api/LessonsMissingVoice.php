<?php


require_once ('../layouts/app_header.php');


$lessons = array();


foreach (OriginalVoice::findLessonsMissingVoice() as $lesson){
    $lessons[] = $lesson;
}

echo json_encode($lessons);
