$(document).ready(function() {

    // process the add_new new lesson form 
    $('#add_manuscript').submit(function(event) {


        $('.form-group').removeClass('has-error'); // remove the error class
        $('.help-block').remove(); // remove the error text

        // get the form data
        // there are many ways to get this data using jQuery (you can use the class or id also)
        var formData = {
            'manuscript_url'                    : $('input[name=manuscript_url]').val(),
            'manuscript_text'                     : $('textarea[name=manuscript_text]').val(),
            'localized_for'                       : $('input[name=localized_for]').val(),
            'lesson_id'                       : $('input[name=lesson_id]').val(),
        };

        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'includes/api/manuscript_process_form.php', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode          : true
        })
        // using the done promise callback
            .done(function(data) {

                // log data to the console so we can see
                console.log(data);

                // here we will handle errors and validation messages

                // here we will handle errors and validation messages
                if ( ! data.success) {

                    // handle errors for subject ---------------
                    if (data.errors.manuscript_url) {
                        $('#manuscript_url_group').addClass('has-error'); // add_new the error class to show red input
                        $('#manuscript_url_group').append('<div class="help-block">' + data.errors.manuscript_url + '</div>'); // add_new the actual error message under our input
                    }

                    // handle errors for lesson number ---------------
                    if (data.errors.manuscript_text) {
                        $('#manuscript_text_group').addClass('has-error'); // add_new the error class to show red input
                        $('#manuscript_text_group').append('<div class="help-block">' + data.errors.manuscript_text + '</div>'); // add_new the actual error message under our input
                    }
                } else {
                    // ALL GOOD! just show the success message!
                    $('#alert_area').append('<div class="alert alert-success">' + data.message + '</div>').trigger('reset');
                    var id = "#lesson_item" + data.lesson_id;
                    $(id).hide();
                    $('#form_area').hide();
                    // usually after form submission, you'll want to redirect
                    // window.location = '/thank-you'; // redirect a user to another page
                }
            });

        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });

});