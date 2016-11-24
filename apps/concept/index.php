<? require_once ('../../includes/layouts/header.php');?>
<? require_once ('includes/layouts/app_header.php');?>
<script src="includes/js/app_functions.js"></script>
<script src="includes/js/index.js"></script>


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
        <h3><small>Lesson list</small></h3>
        <div id="lesson_list" class="list-group"></div>
    </div>

    <!--
    * CONTENT AREA
    -->
    <div class="col-sm-9" id="form_area" style="display: none">
        <div class="row">
            <div class="col-md-12">
                <h3>Missing concepts for:</h3>
                <h3><small id="lesson_title_page"></small></h3>
                <hr>
                <div id="lesson_alert_area"></div>
            </div>

            <div class="col-md-6">
                <div id="lesson_video_container" class="embed-responsive embed-responsive-16by9">
                    <video id="lesson_video" controls class="embed-responsive-item">
                        <source id="lesson_video_source"  src="" type="video/mp4">
                    </video>
                </div>
            </div>

            <div class="alert alert-info col-md-6" id="write_concepts_area">
                <form id="write_concepts">
                    <h4 id="form_header"></h4>
                    <div class="form-group"  id="concepts_group">
                        <label>Concepts in video (One per row)</label>
                        <textarea name="concepts" class="form-control" rows="10" placeholder="One concept per line"></textarea>
                    </div>
                    <input type="hidden" name="lesson_id" value="">
                    <div class="form-group" style="margin-top: 10px">
                        <button type="submit" name="add_new_lesson" value="1" id="form_submit" class="btn btn-lg btn-success">Continue</button>
                    </div>
                </form>


                <form id="add_concepts" style="display: none">
                    <h4 id="form_header">Select the concepts that is specific for this subject</h4>
                    <input type="hidden" name="lesson_id" value="">
                    <input type="hidden" name="all_concepts" value="">
                    <div class="form-group" id="submit_form" style="margin-top: 10px">
                        <button type="submit" name="add_new_lesson" value="1" id="form_submit" class="btn btn-lg btn-success">Add concepts</button>
                    </div>
                </form>





                </div>




        </div>


    </div>
</div>




<? require_once ('includes/layouts/fotter.php'); ?>
