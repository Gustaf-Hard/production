<?php
header('Content-type: text/html; charset=utf-8');

require_once ('../../../includes/classes/db_connection.php');
require_once ('../../../includes/classes/Database.php');
require_once ('../../../includes/classes/DatabaseObject.php');



$db = new Database();


/////////////////////////
// CREATE lesson table
$db->query("DROP TABLE IF EXISTS lesson_lesson");

$query = "CREATE TABLE IF NOT EXISTS lesson_lesson (
		`id`   		            int(11) unsigned 	NULL 	auto_increment,
        `subject_code`            VARCHAR(50)     	NULL 	default NULL,
		`lesson_number` 	    VARCHAR(10)     	    NULL 	default NULL,
		`lesson_name` 	        VARCHAR (500)     	    NULL 	default NULL,
		`added_by` 	            int (10)     	    NULL 	default NULL,
		`created_at`            DATETIME,
		`updated_at`            DATETIME,

		PRIMARY KEY  (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ";

$db->query($query);
$db->query('SET NAMES utf8');


