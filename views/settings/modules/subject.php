

<!----------------------
* SUBJECT SETTINGS
*
*
------------------------>
<script src="js/subjects.js"></script>

<div class="col-md-9 content_settings" id="subjects_settings"  style="display: none">
    <div class="row col-md-12">
        <h2>Subjects</h2>
        <p>Here are all the current languages</p>
        <hr>
    </div>
    <div class="row">
        <div class="col-md-3">
            <p>Added subjects:</p>
            <ul id="subject_list" class="list-group"></ul>
        </div>
        <div class="col-md-9">
            <div id="form_area" style="">
                <div class="alert alert-info">

                    <!-- ADD NEW SUBJECT -->
                    <form id="add_subject">
                        <h4 id="form_header">Add new subject</h4>
                        <div class="form-group"  id="subject_name_group">
                            <label>Subject name (In english)</label>
                            <input type="text" name="subject_name" class="form-control" placeholder="URL">
                        </div>
                        <div class="form-group"  id="subject_code_group">
                            <label>Subject swedish code (eg. MAH)</label>
                            <input type="text" name="subject_code" class="form-control" placeholder="URL" style="text-transform:uppercase" maxlength="3">
                        </div>
                        <div class="form-group"  id="subject_int_code_group">
                            <label>Subject international code (eg. MAS)</label>
                            <input type="text" name="subject_int_code" class="form-control" placeholder="URL" style="text-transform:uppercase" maxlength="3">
                        </div>
                        <div class="form-group" style="margin-top: 10px">
                            <button type="submit" name="add_new_lesson" value="1" id="form_submit" class="btn btn-lg btn-success">Add new subject</button>
                        </div>
                    </form>


                </div>
            </div>


        </div>

    </div>

</div>