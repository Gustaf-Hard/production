<?php
header('Content-type: text/html; charset=utf-8');

require_once ('../../../includes/classes/db_connection.php');
require_once ('../../../includes/classes/Database.php');
require_once ('../../../includes/classes/DatabaseObject.php');



$db = new Database();


/////////////////////////
// CREATE lesson table
$db->query("DROP TABLE IF EXISTS production_voice");

$query = "CREATE TABLE IF NOT EXISTS production_voice (
		`id`   		            int(11) unsigned 	NULL 	auto_increment,
        `lesson_id`             int(11)     	    NULL 	default NULL,
		`voice_url` 	        VARCHAR(1000)     	NULL 	default NULL,
		`language_id` 	        int(11)     	    NULL 	default NULL,
		`file_name` 	        VARCHAR(255)    	NULL 	default NULL,
		`added_by` 	            int (11)     	    NULL 	default NULL,
		`created_at`            DATETIME,
		`updated_at`            DATETIME,

		PRIMARY KEY  (`id`)
	) ENGINE=InnoDB";

$db->query($query);
$db->query('SET NAMES utf8');




