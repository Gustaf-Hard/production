<? require_once ('../../includes/layouts/header.php'); ?>




<script src="js/settings_page.js"></script>







<div class="row" style="margin-top: 10px">

    <div class="col-sm-12">
        <div class="row">
            <div class="col-md-12">
                <h3 id="profile_user_fullname"><?= $_SESSION['name'] ?></h3><!-- Full name is added in users.js -->
                <hr>
                <?= var_dump($_SESSION) ?>


                <legend>Permissions</legend>
                <legend>Statistics</legend>
                <legend>Payments</legend>
                <legend>User log</legend>
            </div>
        </div>
    </div>
</div>






<!--

permission_name

app
action
langugage
country



-->


