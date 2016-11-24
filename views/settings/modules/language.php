
<!----------------------
* LANGUAGE SETTINGS
*
*
------------------------>

<script src="js/languages.js"></script>


<div class="col-md-9 content_settings" id="languages_settings"  style="display: none">
    <div class="row col-md-12">
        <h2>Countries</h2>
        <p>Here are all the current languages</p>
        <hr>
    </div>
    <div class="row">
        <div class="col-md-3">
            <p>Added countries:</p>
            <ul id="language_list" class="list-group"></ul>
        </div>
        <div class="col-md-9">
            <div id="form_area" style="">
                <div class="alert alert-info">
                    <!-- ADD NEW SUBJECT -->
                    <form id="add_language">
                        <h4>Add new language!</h4>
                        <div class="form-group"  id="sel_language_group">
                            <label>Select a language</label>
                            <select class="form-control" id="sel_language" name="language">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="form-group" style="margin-top: 10px">
                            <button type="submit" value="1" id="form_submit" class="btn btn-lg btn-success">Add new language</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>