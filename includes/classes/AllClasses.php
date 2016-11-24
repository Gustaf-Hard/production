<?
require_once ('db_connection.php');
require_once ('Database.php');
require_once ('DatabaseObject.php');


require_once ('Concept.php');
require_once ('ConceptsLesson.php');
require_once ('Country.php');
require_once ('Language.php');
require_once ('Lesson.php');
require_once ('Manuscript.php');
require_once ('OriginalVoice.php');
require_once ('Session.php');
require_once ('Subject.php');
require_once ('User.php');
require_once ('UserPermission.php');

$db = new Database();

$api_root = 'http://localhost:8888/production/';  //http://production.studi.se/

