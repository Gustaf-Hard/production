<?php
header('Content-type: text/html; charset=utf-8');

require_once ('../includes/classes/db_connection.php');
require_once ('../includes/classes/Database.php');
require_once ('../includes/classes/DatabaseObject.php');



$db = new Database();








$db->query("DROP TABLE IF EXISTS user_permission");

$query = "CREATE TABLE IF NOT EXISTS user_permission (
		`id`   		            int(11) unsigned 	NULL 	auto_increment,
        `user_id`               int(10)     	NULL 	default NULL,
		`minicipality_id` 	    int(10)     	NULL 	default NULL,
		`school_id` 	        int(10)     	NULL 	default NULL,
		`app_id` 	            int(10)     	NULL 	default NULL,
		`admin` 	            int(10)     	NULL 	default NULL,
		`created_at`            DATETIME,
		`updated_at`            DATETIME,

		PRIMARY KEY  (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ";

$db->query($query);




/////////////////////////
// CREATE lesson table
$db->query("DROP TABLE IF EXISTS subject");

$query = "CREATE TABLE IF NOT EXISTS subject (
		`id`   		            int(11) unsigned 	NULL 	auto_increment,
        `subject_name`          VARCHAR(500)     	NULL 	default NULL,
		`subject_code` 	        VARCHAR (11)     	    NULL 	default NULL,
		`subject_int_code` 	    VARCHAR(11)     	    NULL 	default NULL,
		`added_by` 	            int (11)     	    NULL 	default NULL,
		`created_at`            DATETIME,
		`updated_at`            DATETIME,

		PRIMARY KEY  (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ";

$db->query($query);


$db->query("INSERT INTO subject SET subject_name = 'Mathematics', subject_code = 'MAH', subject_int_code = 'MAS', added_by = '1', created_at = NOW(), updated_at = NOW()");

/////////////////////////
// CREATE language table
$db->query("DROP TABLE IF EXISTS language");

$query = "CREATE TABLE IF NOT EXISTS language (
		`id`   		            int(11) unsigned 	NULL 	auto_increment,
        `code`          VARCHAR(11)     	NULL 	default NULL,
		`language_name` 	        VARCHAR (500)     	    NULL 	default NULL,
		`native_name` 	    VARCHAR(500)     	    NULL 	default NULL,
		`added_by` 	            int (11)     	    NULL 	default NULL,
		`created_at`            DATETIME,
		`updated_at`            DATETIME,

		PRIMARY KEY  (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ";

$db->query($query);

$db->query("INSERT INTO language SET code = 'sv', language_name = 'Swedish', native_name = 'Svenska', added_by = '1', created_at = NOW(), updated_at = NOW()");
$db->query("INSERT INTO language SET code = 'en', language_name = 'English', native_name = 'English', added_by = '1', created_at = NOW(), updated_at = NOW()");



/////////////////////////
// CREATE country table
$db->query("DROP TABLE IF EXISTS country");

$query = "CREATE TABLE IF NOT EXISTS country (
		`id`   		            int(11) unsigned 	NULL 	auto_increment,
        `code`                  VARCHAR(11)     	NULL 	default NULL,
		`country_name` 	        VARCHAR (500)     	    NULL 	default NULL,
		`native_name` 	        VARCHAR(500)     	    NULL 	default NULL,
		`added_by` 	            int (11)     	    NULL 	default NULL,
		`created_at`            DATETIME,
		`updated_at`            DATETIME,

		PRIMARY KEY  (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ";

$db->query($query);

$db->query("INSERT INTO country SET code = 'se', country_name = 'Sweden', native_name = 'Sverige', added_by = '1', created_at = NOW(), updated_at = NOW()");
$db->query("INSERT INTO country SET code = 'de', country_name = 'Germany', native_name = 'Deuschland', added_by = '1', created_at = NOW(), updated_at = NOW()");


/////////////////////////
// CREATE country table
$db->query("DROP TABLE IF EXISTS country_language");

$query = "CREATE TABLE IF NOT EXISTS country_language (
		`id`   		            int(11) unsigned 	NULL 	auto_increment,
        `country_id`            int(11)     	NULL 	default NULL,
        `language_id`           int(11)     	NULL 	default NULL,
		`added_by` 	            int (11)     	    NULL 	default NULL,
		`created_at`            DATETIME,
		`updated_at`            DATETIME,

		PRIMARY KEY  (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ";

$db->query($query);

$db->query("INSERT INTO country_language SET country_id = '1', language_id = '1',  added_by = '1', created_at = NOW(), updated_at = NOW()");
$db->query("INSERT INTO country_language SET country_id = '1', language_id = '2',  added_by = '1', created_at = NOW(), updated_at = NOW()");


/////////////////////////
// CREATE country table
$db->query("DROP TABLE IF EXISTS concepts");


$query = "CREATE TABLE IF NOT EXISTS concepts (
		`id`   		            int(11) unsigned 	NULL 	auto_increment,
        `subject_id`            int(11)     	NULL 	default NULL,
        `concept`               VARCHAR(50)     	NULL 	default NULL,
        `inflection`            VARCHAR (1000)     	NULL 	default NULL,
        `synonyms`              VARCHAR (1000)     	NULL 	default NULL,
        `explanation`           TEXT         	    NULL 	default NULL,
        `img_url`               VARCHAR(256)     	NULL 	default NULL,
		`added_by` 	            int (11) unsigned   NULL 	default NULL,
		`created_at`            DATETIME,
		`updated_at`            DATETIME,

		PRIMARY KEY  (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ";

$db->query($query);

/////////////////////////
// CREATE country table
$db->query("DROP TABLE IF EXISTS concepts_lesson");


$query = "CREATE TABLE IF NOT EXISTS concepts_lesson (
		`id`   		            int(11) unsigned 	NULL 	auto_increment,
        `concept_id`            int(11)     	    NULL 	default NULL,
        `lesson_id`             int (11)     	    NULL 	default NULL,
		`added_by` 	            int (11) unsigned   NULL 	default NULL,
		`created_at`            DATETIME,
		`updated_at`            DATETIME,

		PRIMARY KEY  (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ";

$db->query($query);


/////////////////////////
// CREATE country table
$db->query("DROP TABLE IF EXISTS ceoncepts_subject");
$db->query("DROP TABLE IF EXISTS concepts_subject");




/////////////////////////
// CREATE country table
$db->query("DROP TABLE IF EXISTS apps");


$query = "CREATE TABLE IF NOT EXISTS apps (
		`id`   		            int(11) unsigned 	NULL 	auto_increment,
        `ord`                   int (11)     	    NULL 	default NULL,
        `menu_name`             VARCHAR (150)     	    NULL 	default NULL,
        `app_name`              VARCHAR (150)     	    NULL 	default NULL,
        `app_url`               VARCHAR (256)     	    NULL 	default NULL,
        `disabled`              TINYINT (1)     	    NULL 	default NULL,
		`created_at`            DATETIME,
		`updated_at`            DATETIME,

		PRIMARY KEY  (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ";


$db->query($query);


$db->query("INSERT INTO apps SET ord = '1', menu_name = 'Lessons', app_name = 'All lessons',  app_url = NULL, disabled = 1, created_at = NOW(), updated_at = NOW()");
$db->query("INSERT INTO apps SET ord = '2', menu_name = 'Lessons', app_name = 'Curriculums / lists',  app_url = NULL, disabled = 1, created_at = NOW(), updated_at = NOW()");
$db->query("INSERT INTO apps SET ord = '3', menu_name = 'Lessons', app_name = '-',  app_url = NULL, disabled = 0, created_at = NOW(), updated_at = NOW()");
$db->query("INSERT INTO apps SET ord = '4', menu_name = 'Lessons', app_name = 'Add new lesson',  app_url = NULL, disabled = 1, created_at = NOW(), updated_at = NOW()");


$db->query("INSERT INTO apps SET ord = '1', menu_name = 'Production', app_name = 'Manuscripts',  app_url = NULL, disabled = 1, created_at = NOW(), updated_at = NOW()");
$db->query("INSERT INTO apps SET ord = '2', menu_name = 'Production', app_name = 'Original voice',  app_url = NULL, disabled = 1, created_at = NOW(), updated_at = NOW()");
$db->query("INSERT INTO apps SET ord = '3', menu_name = 'Production', app_name = 'Video production',  app_url = NULL, disabled = 1, created_at = NOW(), updated_at = NOW()");
$db->query("INSERT INTO apps SET ord = '4', menu_name = 'Production', app_name = 'Quiz production',  app_url = NULL, disabled = 1, created_at = NOW(), updated_at = NOW()");
$db->query("INSERT INTO apps SET ord = '5', menu_name = 'Production', app_name = 'Subtitle',  app_url = NULL, disabled = 1, created_at = NOW(), updated_at = NOW()");
$db->query("INSERT INTO apps SET ord = '6', menu_name = 'Production', app_name = 'Concepts',  app_url = 'apps/concept/', disabled = 0, created_at = NOW(), updated_at = NOW()");
$db->query("INSERT INTO apps SET ord = '7', menu_name = 'Production', app_name = 'Images',  app_url = 'apps/images/', disabled = 0, created_at = NOW(), updated_at = NOW()");
$db->query("INSERT INTO apps SET ord = '8', menu_name = 'Production', app_name = '-',  app_url = NULL, disabled = 0, created_at = NOW(), updated_at = NOW()");
$db->query("INSERT INTO apps SET ord = '9', menu_name = 'Production', app_name = 'Release production',  app_url = NULL, disabled = 1, created_at = NOW(), updated_at = NOW()");


$db->query("INSERT INTO apps SET ord = '1', menu_name = 'Translation', app_name = 'Text translation',  app_url = NULL, disabled = 1, created_at = NOW(), updated_at = NOW()");
$db->query("INSERT INTO apps SET ord = '1', menu_name = 'Translation', app_name = 'Text proofread',  app_url = NULL, disabled = 1, created_at = NOW(), updated_at = NOW()");
$db->query("INSERT INTO apps SET ord = '1', menu_name = 'Translation', app_name = 'Text localization',  app_url = NULL, disabled = 1, created_at = NOW(), updated_at = NOW()");
$db->query("INSERT INTO apps SET ord = '8', menu_name = 'Translation', app_name = '-',  app_url = NULL, disabled = 0, created_at = NOW(), updated_at = NOW()");
$db->query("INSERT INTO apps SET ord = '1', menu_name = 'Translation', app_name = 'Quiz translation',  app_url = NULL, disabled = 1, created_at = NOW(), updated_at = NOW()");
$db->query("INSERT INTO apps SET ord = '2', menu_name = 'Translation', app_name = 'Quiz proofread',  app_url = NULL, disabled = 1, created_at = NOW(), updated_at = NOW()");
$db->query("INSERT INTO apps SET ord = '3', menu_name = 'Translation', app_name = 'Quiz localization',  app_url = NULL, disabled = 1, created_at = NOW(), updated_at = NOW()");
$db->query("INSERT INTO apps SET ord = '8', menu_name = 'Translation', app_name = '-',  app_url = NULL, disabled = 0, created_at = NOW(), updated_at = NOW()");
$db->query("INSERT INTO apps SET ord = '4', menu_name = 'Translation', app_name = 'Add Subtitle',  app_url = NULL, disabled = 1, created_at = NOW(), updated_at = NOW()");
$db->query("INSERT INTO apps SET ord = '4', menu_name = 'Translation', app_name = 'Subtitle translation',  app_url = NULL, disabled = 1, created_at = NOW(), updated_at = NOW()");
$db->query("INSERT INTO apps SET ord = '5', menu_name = 'Translation', app_name = 'Subtitle proofread',  app_url = NULL, disabled = 1, created_at = NOW(), updated_at = NOW()");
$db->query("INSERT INTO apps SET ord = '6', menu_name = 'Translation', app_name = 'Subtitle localization',  app_url = NULL, disabled = 1, created_at = NOW(), updated_at = NOW()");
$db->query("INSERT INTO apps SET ord = '8', menu_name = 'Translation', app_name = '-',  app_url = NULL, disabled = 0, created_at = NOW(), updated_at = NOW()");
$db->query("INSERT INTO apps SET ord = '7', menu_name = 'Translation', app_name = 'Dubbing',  app_url = NULL, disabled = 1, created_at = NOW(), updated_at = NOW()");
$db->query("INSERT INTO apps SET ord = '8', menu_name = 'Translation', app_name = 'Video proofwatch',  app_url = NULL, disabled = 1, created_at = NOW(), updated_at = NOW()");





