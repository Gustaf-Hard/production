<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);




$root = 'http://' . getenv('HTTP_HOST') . '/production/';
$root2 = $_SERVER["DOCUMENT_ROOT"]."/production/";

$root3 = dirname(__FILE__)."/../../";
require_once ($root3."includes/classes/db_connection.php");
require_once ($root3."includes/classes/Session.php");



if(!$session->is_logged_in()){
    $database->redirect_to('login.php');
}

?>
<script> var root = '<?= $root ?>'</script>


<? $db = new Database(); ?>

<script>var page_name = 'Home page'; </script>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Title</title>


    <!-- jQuery library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script src="<?= $root ?>includes/js/general_functions.js"></script>
    <link rel="stylesheet" href="<?= $root?>includes/css/main.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">





</head>
<body>
<div class="container">
    <nav class="navbar navbar-default" style="margin-bottom: 0px">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?= $root?>">Studi production</a>
            </div>

            <!-- The content in the main menu iss added from general_functions.js -->
            <ul class="nav navbar-nav" id="main_navigation"></ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?= $_SESSION['name'] ?>
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href='<?= $root ?>views/profile/'>Profile</a></li>
                        <li><a href='<?= $root ?>views/settings/'>Settings</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href='<?= $root ?>login.php'>Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</div>

<div class="container">
    <div class="page-title" id="page-title"></div>
