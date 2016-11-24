$(document).ready(function() {
    var concepts = [];
    var timer;

    
    
    
    /*      
     * STRUCTURE:
     *  1. Form related and lesson list
     *  2. Helpers (Like slow video down or disable submit or loaders)
     *  3. General functions
     */
    
    
    
    

    

    //****************************************************************************************************************//
    /*   1. FORM RELATES   */



     // POPULATE THE LESSON LIST
    $.getJSON("../../api/lessons/missing_concepts/", function (data) {
        $.each(data, function () {
            $('#lesson_list').append('<a class="list-group-item lesson_item" id="lesson_item' + this.id  + '"><p><strong> ' + this.subject_code + this.lesson_number + '</strong></p><p><small>' + this.lesson_name + '</small> </p> <span id="lesson_id" style="display: none">' + this.id + '</span></a>');
            var id = this.id;
            var lesson_name = this.lesson_name;
            var lesson_subject = this.subject_code;
            var lesson_number = this.lesson_number;
            var en_video_url = this.en_video_url;


    /* ****************
     * FORM 1
     *  - Add all the concepts you see in teh lesson
     */
            $('#lesson_item' + this.id ).click(function(){
                resetForms();
                $("#form_area").show();

                $('input[name=lesson_id]').val(id);
                $("#lesson_video_container video source").attr("src", en_video_url);
                $("#lesson_video_container video")[0].load();
                $("#lesson_video_container video")[0].play();
                var video = $("#lesson_video")[0];
                video.playbackRate = 1.4;
                $('#lesson_title_page').html("[" + lesson_subject + lesson_number + "] " + lesson_name);
            });
        });
    });






    /* ****************
     * FORM 2
     *  - Check if the concept is subject specific or not.
     */
    $('#write_concepts').submit(function(event){
        event.preventDefault();
        // Hide form 1
        $('#write_concepts').hide();
        // Add the checkboxes
        $.each(     $('textarea[name=concepts]').val().split('\n')      , function(){
            //Remove empty rows
            if(this.replace(/(?:\r\n|\r|\n|\s)/g, '') !== ''){
                $('#submit_form').prepend('<div class="checkbox"><label><input type="checkbox" name="concepts" value="'+ this +'">'+ this +'</label></div>')
                concepts.push(this);
            }
        });
        // Add  the concepts to the form.
        $('input[name=all_concepts]').val(concepts);
        $('#add_concepts').show();
        $('#lesson_video').hide();
        $("#lesson_video_container video")[0].pause();
    });













    /**************************************
     * ADD NEW CONCEPT TO THE DB
     * - Process teh form
     */
    $('#add_concepts').submit(function(event) {
        var concepts = [];
        $. each($("input[name='concepts']:checked"), function(){
            concepts. push($(this). val());
        });

        $('.form-group').removeClass('has-error'); // remove the error class
        $('.help-block').remove(); // remove the error text

        // get the form data
        // there are many ways to get this data using jQuery (you can use the class or id also)
        var formData = {
            'subject_specific'                 : concepts,
            'all_concepts'                     : $('input[name=all_concepts]').val(),
            'lesson_id'                        : $('input[name=lesson_id]').val(),
        };

        console.log(concepts);
        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : root + 'api/concepts/add_new/', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode          : true
        })

        // using the done promise callback

            .done(function(data) {

                // log data to the console so we can see
                //console.log(data);

                // here we will handle errors and validation messages

                // here we will handle errors and validation messages
                if ( ! data.success) {
                    // handle errors for subject ---------------
                    if (data.errors.language) {
                        $('#sel_language_group').addClass('has-error'); // add_new the error class to show red input
                        $('#lesson_alert_area').append('<div class="help-block">' + data.errors.subject + '</div>'); // add_new the actual error message under our input
                        $('#lesson_alert_area').append('<div class="alert alert-warning">' + data.errors.subject + '</div>').trigger('reset');

                    }
                } else {
                    
                    var conceptsAdded = 0;
                    
                    // ALL GOOD! just show the success message!

                    $.each(data.concepts_added, function () {
                        console.log('-' + this);
                        $('#lesson_alert_area').append('<div class="alert alert-success">The word <strong>' + this + '</strong> was added.</div>').trigger('reset');
                    });
                    $.each(data.concepts_lesson, function () {
                        console.log('-' + this);
                        $('#lesson_alert_area').append('<div class="alert alert-success">The word <strong>' + this + '</strong> was linked to the lesson.</div>').trigger('reset');
                        conceptsAdded++;
                    });
                    $.each(data.concepts_lesson_not_added, function () {
                        console.log('-' + this);
                        $('#lesson_alert_area').append('<div class="alert alert-warning">The word <strong>' + this + '</strong> was linked to the lesson since it already are.</div>').trigger('reset');
                    });
                    $.each(data.concepts_not_added, function () {
                        console.log('-' + this);
                        $('#lesson_alert_area').append('<div class="alert alert-warning">The word <strong>' + this + '</strong> was not added since it was already there.</div>').trigger('reset');
                    });
                    console.log(conceptsAdded);

                    
                    
                    $('#write_concepts_area').hide();
                    $('#lesson_video').hide();
                    $('#lesson_item' + data.lesson_id).hide();
                    $("#lesson_video_container video")[0].pause();



                    // usually after form submission, you'll want to redirect
                    // window.location = '/thank-you'; // redirect a user to another page
                }

            });

        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });



    
    
    
    
    
    

    //****************************************************************************************************************//
    /*   2. HELPERS   */


     /* ****************
     * SLOW VIDEO
     *  - Make the video play slow while writing
     */
    $( "#concepts_group textarea" ).keypress(function() {
        var video = $("#lesson_video")[0];
        video.playbackRate = 0.5;
        clearTimeout(timer);
        timer = setTimeout(function (event) {
            video.playbackRate = 1.4;
        }, 1000);
    });


    /* ****************
     * DISABLE SUBMIT
     *  - If the content in form is empty.
     */
    $('#form_submit').prop('disabled',true);
    $('#concepts_group textarea').keyup(function(){
        str = this.value.replace(/(?:\r\n|\r|\n|\s)/g, '');
        $('#form_submit').prop('disabled', str == "" ? true : false);
    });


    
    
    
    
    
    
    
    


    //****************************************************************************************************************//
    /*   3. FUNCTIONS   */


    /* ****************
     * FUNCTIONS
     *  - All functions to help the page
     */

    // Bring the page back to normal.
    function resetForms(){
        // Resent the form
        $('#concepts_group textarea').val('');
        $('#concepts_group input').val('');
        $('#add_concepts input').val('');

        // restet the concepts added to varable
        concepts = [];

        // Remove all added content
        $('.checkbox').remove();
        $('.alert-warning').remove();
        $('.alert-success').remove();

        // Ide the form part 2
        $("#add_concepts").hide();

        // Show the video
        $('#lesson_video').show();
        // Show the concepts area
        $('#write_concepts_area').show();
        $("#write_concepts").show();
    }


    function checkStringEmptyRows(string) {
        var empty = true;
        $.each($(string).split('\n'), function () {
            if ($(this).val() !== '') {
                empty = false;
            }
        });
        return empty;
    }



    //****************************************************************************************************************//
    
    
});

