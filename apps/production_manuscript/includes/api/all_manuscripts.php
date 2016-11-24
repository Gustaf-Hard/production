<?php


require_once ('../layouts/app_header.php');


$lessons = array();





$result = $db->query("SELECT 
lesson_lesson.id, 
lesson_lesson.subject_code, 
lesson_lesson.lesson_number, 
lesson_lesson.lesson_name, 
production_manuscript.manuscript_url,
production_manuscript.localized_for,
production_manuscript.manuscript_text,
production_manuscript.added_by,
production_manuscript.created_at

FROM lesson_lesson 
                                        RIGHT JOIN production_manuscript
                                        ON lesson_lesson.id=production_manuscript.lesson_id");


foreach($result as $lesson){
    //var_dump($lesson);
    $lessons[] = $lesson;
}

echo json_encode($lessons);
