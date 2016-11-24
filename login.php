<?
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once ("includes/classes/db_connection.php");

require_once ("includes/classes/Database.php");
require_once("includes/classes/DatabaseObject.php");
require_once ("includes/classes/User.php");
require_once ("includes/classes/Session.php");

$db = New Database();


if($session->is_logged_in()){
    $session->logout();
}

if(isset($_POST['submit'])){
    User::AttemptToLogIn($_POST['user_name'], $_POST['password']);
} else { // Form have not been submitted
    $username = "";
    $password = "";
}








?>


<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Title</title>
    <link rel="stylesheet" href="includes/css/bootstrap.min.css">
    <link rel="stylesheet" href="includes/css/main.css">

    <!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">


    <!-- jQuery library -->
    <script src="includes/js/jquery.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script> -->

    <!-- Latest compiled JavaScript -->
    <script src="includes/js/bootstrap.min.js"></script>
    <!-- <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
</head>
<body>
<div class="container">

    <div class="col-lg-4 col-lg-offset-4">
        <?= Session::Message() ?>
        <form class="form-signin" action="" method="POST">
            <h2 class="form-signin-heading">Please sign in</h2>
            <div class="form-group">
                <input type="test" name="user_name" class="form-control" placeholder="Username" required="" autofocus="">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required="">
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button>
        </form>

    </div>


</div>




<br><br><br><br><br>
</body>
</html>