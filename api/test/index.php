<? require_once ('../../includes/classes/AllClasses.php');

$lessons = json_decode(file_get_contents('http://api.studi.se/1.1/lessons/translations'));
if(isset($_GET['lang'])){
    foreach ($lessons as $lesson){
        if(in_array($_GET['lang'], $lesson->video_languages)){
            echo '<a href="https://www.studi.se/l/' . $lesson->slug . '">' . $lesson->title . '</a><br>';
        }
    }
}




