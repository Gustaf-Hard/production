<? require_once ('includes/layouts/app_header.php');?>




<? require_once ($_SERVER['DOCUMENT_ROOT'] . ROOT . 'includes/layouts/header.php'); ?>





<?php


$manuscript = Manuscript::find_by_id(10);

$rows = explode(PHP_EOL, $manuscript->manuscript_text);

var_dump($rows[3]);
echo nl2br($manuscript->manuscript_text);


