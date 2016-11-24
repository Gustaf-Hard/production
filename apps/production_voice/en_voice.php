<?




require_once ('includes/layouts/app_header.php');?>




<? require_once ($_SERVER['DOCUMENT_ROOT'] . ROOT . 'includes/layouts/header.php'); ?>



<script src="includes/js/lessons_missing_voice.js"></script>
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
<? require_once ('includes/layouts/menu.php'); ?>



<div class="row">
    <div class="col-md-12" id="alert_area">


    </div>
    <div class="col-sm-3 lesson_list_container">
        <h3><small>Lesson list</small></h3>
        <div id="lesson_list" class="list-group"></div>
    </div>
    <div class="col-sm-9" id="form_area" style="display: none">
        <div class="alert alert-info">
            <form id="add_manuscript">
                <h4 id="form_header"></h4>
                <div class="form-group"  id="manuscript_url_group">
                    <label>Url to manuscript</label>
                    <input type="text" name="manuscript_url" class="form-control" placeholder="URL">
                </div>
                <div class="form-group"  id="manuscript_text_group">
                    <label>Url to manuscript</label>
                    <textarea name="manuscript_text" class="form-control" placeholder="The full manuscript text."></textarea>
                </div>
                <input type="hidden" name="lesson_id" value="">
                <input type="hidden" name="localized_for" value="1">
                <div class="form-group" style="margin-top: 10px">
                    <button type="submit" name="add_new_lesson" value="1" id="form_submit" class="btn btn-lg btn-success">Add new lesson</button>
                </div>
            </form>
        </div>
    </div>
</div>




<? require_once ('includes/layouts/fotter.php'); ?>
