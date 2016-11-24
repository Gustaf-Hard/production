<? require_once ('../../includes/classes/AllClasses.php');


echo isset($_GET['subject_code'])
    ? json_encode(Subject::findByCode($_GET['subject_code']))
    : json_encode(Subject::find_all());


