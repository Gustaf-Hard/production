<? require_once ('../../includes/layouts/header.php');?>
<? require_once ('includes/layouts/app_header.php');?>
<script src="includes/js/inflections.js"></script>


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
    <!--
    * APP ALERT
    -->
    <div class="col-md-12" id="alert_area"></div>

    <!--
    * LESSON LIST
    -->
    <div class="col-sm-3 lesson_list_container">
        <h3><small>Concept list</small></h3>
        <div id="lesson_list" class="list-group"></div>
    </div>

    <!--
    * CONTENT AREA
    -->
    <div class="col-sm-9" id="form_area" style="display: none">
        <div class="row">
            <div class="col-md-12">
                <h3>Missing inflections for:</h3>
                <h3><small id="lesson_title_page"></small></h3>
                <hr>
                <div id="lesson_alert_area"></div>
            </div>
        </div>
        <div class="row">
            <div class="alert alert-info col-md-6" id="write_concepts_area">
                <span id="similar_concepts_header"></span> <!-- header if shown if there is same concepts -->
                <span id="similar_concepts"></span> <!-- Show all similar concepts -->


                <form id="write_concepts_info">
                    <h4 id="form_header"></h4>
                    <div class="form-group needed"  id="inflections_form_group">
                        <label>Write all inflections you can come up with</label>
                        <textarea name="inflections" class="form-control" rows="5" placeholder="One concept per line"></textarea>
                    </div>
                    <div class="form-group"  id="synonyms_form_group">
                        <label>Write all synonyms in base form [optional]</label>
                        <textarea name="synonyms" class="form-control" rows="5" placeholder="One concept per line"></textarea>
                    </div>
                    <div class="form-group needed"  id="explanation_form_group">
                        <label>Explain the word as short as possible</label>
                        <textarea name="explanation" class="form-control" rows="3" maxlength="100"></textarea>
                        <span id="max_words"></span>
                    </div>
                    <input type="hidden" name="concept_id" value="">
                    <div class="form-group" style="margin-top: 10px">
                        <button type="submit" name="add_new_lesson" value="1" id="form_submit" class="btn btn-lg btn-success">Save</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6" id="concept_info"></div>
        </div>

    </div>
</div>




<? require_once ('includes/layouts/fotter.php'); ?>
