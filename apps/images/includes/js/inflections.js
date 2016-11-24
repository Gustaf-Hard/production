$(document).ready(function() {
    var concepts = [];
    var timer;


    // POPULATE THE LESSON LIST
    $.getJSON("../../api/concepts/missing_inflections/", function (data) {
        $.each(data, function () {
            $('#lesson_list').append('<a class="list-group-item lesson_item" id="lesson_item' + this.id  + '"><p><strong> ' + this.concept + '</strong></p><p><small>' + this.subject_name + '</small> </p> <span id="lesson_id" style="display: none">' + this.id + '</span></a>');
            var id = this.id;
            var concept = this.concept;
            // SHOW FORM AND ADD VARABLES TO FORM
            $('#lesson_item' + this.id ).click(function(){
                resetForms();
                $("#form_area").show();

                $('input[name=concept_id]').val(id);
                $('#lesson_title_page').html(concept);


                conceptInfo(concept, '#concept_info');

            });
        });
    });



    // SET TEH FORM MAX LENGTH
    var maxLength = 100;
    $('#concept_explanation textarea').keyup(function() {
        var length = $(this).val().length;
        var length = maxLength-length;
        $('#max_words').text(length + ' characters left');
    });



    // Disable the submit button
    $('#form_submit').prop('disabled',true);

    $('#concept_explanation textarea').keyup(function(){
        str = this.value.replace(/(?:\r\n|\r|\n|\s)/g, '');
        $('#form_submit').prop('disabled', str == "" ? true : false);
    });





    function conceptInfo(concept, appendTo){
        $.getJSON("../../api/concepts/definitions/?word=" + concept, function (data) {
            $(appendTo).html('');
            $(appendTo).append('<h3><small>All about the word:</small></h3>');

            // ADD DEFINITIONS
            var definition = false;
            $.each(data.definitions, function () {
                $(appendTo).append('<li id="concept_definitions">' + this + '</li>');
                definition = true;
            });
            definition ? $('#concept_definitions').before('<strong>Definitions</strong>') : false;


            // ADD SYNONYMS
            var synonyms = false;
            $.each(data.synonyms, function () {
                $(appendTo).append('<li id="concept_synonyms">' + this + '</li>');
                synonyms = true;
            });
            synonyms ? $('#concept_synonyms').before('<br><strong>Synonyms</strong>') : false;

            // ADD EXAMPLES
            var examples = false;
            $.each(data.examples, function () {
                $(appendTo).append('<li id="concept_examples">' + this + '</li>');
                examples = true;
            });
            examples ? $('#concept_examples').before('<br><strong>Examples</strong>') : false;

        });
    }



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

    // FORM 2
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
    });






    /**************************************
     * ADD NEW CONCEPT
     * Process teh form
     */
    $('#write_concepts_info').submit(function(event) {
        event.preventDefault();
        var inflections = [];
        $.each(     $('textarea[name=inflections]').val().split('\n')      , function(){
            //Remove empty rows
            if(this.replace(/(?:\r\n|\r|\n|\s)/g, '') !== ''){
                inflections.push(this);
            }
        });

        var synonyms = [];
        $.each(     $('textarea[name=synonyms]').val().split('\n')      , function(){
            //Remove empty rows
            if(this.replace(/(?:\r\n|\r|\n|\s)/g, '') !== ''){
                synonyms.push(this);
            }
        });


        $('.form-group').removeClass('has-error'); // remove the error class
        $('.help-block').remove(); // remove the error textExplain the word as short as possible

        // get the form data
        // there are many ways to get this data using jQuery (you can use the class or id also)
        var formData = {
            'concept_id'                   : $('input[name=concept_id]').val(),
            'inflections'                  : inflections,
            'synonyms'                     : inflections,
            'explanation'                  : $('textarea[name=explanation]').val(),
        };

        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : '../../api/concepts/update/', // the url where we want to POST
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
                        $('#sel_language_group').append('<div class="help-block">' + data.errors.language + '</div>'); // add_new the actual error message under our input
                    }
                } else {

                    if(data.message){
                        $('#lesson_alert_area').append('<div class="alert alert-success">' + data.message + '</div>').trigger('reset');
                    }
                    $('#write_concepts_area').hide();
                    $('#lesson_item' + data.concept_id).hide();

                    // usually after form submission, you'll want to redirect
                    // window.location = '/thank-you'; // redirect a user to another page
                }

            });

        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });

});

