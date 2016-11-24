<?php


require_once ('../layouts/app_header.php');


$lessons = array();


foreach (Manuscript::findLessonsMissingManuscript() as $lesson){
    $lessons[] = $lesson;
}

echo json_encode($lessons);
