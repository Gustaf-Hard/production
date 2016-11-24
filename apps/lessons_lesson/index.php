<? require_once ('../../includes/layouts/header.php');?>
<? require_once ('includes/layouts/app_header.php');?>




<script src="includes/js/add_lesson_form.js"></script>

<div class="container" style="margin-top: 20px">

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

<div class="row">
    <div class="col-md-8">
        <div id="list_added_lessons" class="list-group">
            <? foreach (Lesson::find_all_reverse() as $lesson): ?>
                <a href="#" class="list-group-item lesson_item"><p><strong><?= $lesson->subject_code.$lesson->lesson_number ?> </strong></p>
                    <p> <small><?= $lesson->lesson_name ?></small></p>
                    <p><small> Added at: <?= $lesson->created_at ?></small></p></a>
            <? endforeach; ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="alert alert-info">
            <form id="add_lesson">
                <legend>Add new lesson</legend>
                <div class="row">
                        <div class="form-group col-sm-4" id="lesson_subject_group">
                            <!-- Populated with javascript -->
                        <select name="lesson_subject" id="lesson_subject" class="form-control"></select>
                    </div>
                    <div class="form-group col-sm-8"  id="lesson_number_group">
                        <input type="number" name="lesson_number" id="lesson_number" class="form-control" placeholder="Enter lesson number">
                    </div>
                </div>
                <div class="form-group"  id="lesson_name_group">
                    <label>Lesson name in english</label>
                    <input type="text" name="lesson_name" class="form-control" placeholder="Lesson name">
                </div>
                <div class="form-group" style="margin-top: 10px">
                    <button type="submit" name="add_new_lesson" value="1" id="form_submit" class="btn btn-lg btn-success">Add new lesson</button>
                </div>
            </form>
        </div>
    </div>


</div>


<? require_once ('includes/layouts/fotter.php'); ?>
