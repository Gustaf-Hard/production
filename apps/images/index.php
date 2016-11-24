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

<div class="row">
    <!--
    * APP ALERT
    -->
    <div class="col-md-12" id="alert_area"></div>

    <!--
    * LESSON LIST
    -->
    <div class="col-md-12">
        <div class="jumbotron">
            <div class="container">
                <h1>Search the image library</h1>

                <form role="form" id="search_image">
                    <div class="row">
                        <div class="form-group">
                            <input type="text" id="query" name="query" class="form-control input-lg" placeholder="Search for...">
                        </div>
                    </div>

                    <div class="row">
                        <button type="submit" class="btn btn-primary btn-lg">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-12" id="image_area">
        


    </div>


</div>




<? require_once ('includes/layouts/fotter.php'); ?>
