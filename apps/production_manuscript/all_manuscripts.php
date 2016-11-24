<? require_once ('includes/layouts/app_header.php');?>
<? require_once ($_SERVER['DOCUMENT_ROOT'] . ROOT . 'includes/layouts/header.php'); ?>
<script> var page_name = 'Manuscript'; </script>
<script src="includes/js/all_manuscripts.js"></script>
<script src="includes/js/manuscript_form_process.js"></script>




    <!--
    |--------------------------------------------------------------------------
    | Add new lesson
    |--------------------------------------------------------------------------
    |
    | First select subject id. It can be added in another form in another app.
    | Todo: APP - Add a subject app.
    | And select what lesson number
    | Todo: Check so that the lesson do not exist already.
    |
    -->
<div class="row col-md-12">
    <ul class="nav nav-tabs">
        <li role="presentation"><a href="index.php">Add manuscript</a></li>
        <li role="presentation" class="active"><a href="">All manuscripts</a></li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12" id="alert_area">


    </div>
    <div class="col-sm-3 lesson_list_container">
        <h3><small>Lesson list</small></h3>
        <div id="lesson_list" class="list-group"></div>
    </div>
    <div class="col-sm-9" id="form_area" style="display: none">
        <div class="row col-md-12">
            <h4 id="lesson_code_header"></h4>
            <h3 id="lesson_name_header"></h3>
            <p id="lesson_date_created"></p>
            <a href="" class="btn btn-md btn-success">Go to manuscript</a>
            <hr>

        </div>
        <div class="row col-md-12">
            <div class="embed-responsive embed-responsive-4by3">
                <iframe id="manuscript_iframe" class="embed-responsive-item" src=""></iframe>
            </div>
        </div>


    </div>
</div>




<? require_once ('includes/layouts/fotter.php'); ?>
