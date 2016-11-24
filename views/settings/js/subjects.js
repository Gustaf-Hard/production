$(document).ready(function() {
    /*
     * LIST ALL SUBJECTS
     */
    $.getJSON(root + "api/subject/", function (data) {
        $.each(data, function () {
            $('#subject_list').append('<li class="list-group-item">' + this.subject_name + '</li>');
        });
    });






    /**************************************
     * ADD NEW SUBJECT
     * Process teh form
     */
    $('#add_subject').submit(function(event) {
        $('.form-group').removeClass('has-error'); // remove the error class
        $('.help-block').remove(); // remove the error text

        // get the form data
        // there are many ways to get this data using jQuery (you can use the class or id also)
        var formData = {
            'subject_name'                    : $('input[name=subject_name]').val(),
            'subject_code'                    : $('input[name=subject_code]').val(),
            'subject_int_code'                : $('input[name=subject_int_code]').val(),
        };

        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : root + 'api/subject/add_new.php', // the url where we want to POST
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
                    if (data.errors.subject_name) {
                        $('#subject_name_group').addClass('has-error'); // add_new the error class to show red input
                        $('#subject_name_group').append('<div class="help-block">' + data.errors.subject_name + '</div>'); // add_new the actual error message under our input
                    }

                    // handle errors for lesson number ---------------
                    if (data.errors.subject_code) {
                        $('#subject_code_group').addClass('has-error'); // add_new the error class to show red input
                        $('#subject_code_group').append('<div class="help-block">' + data.errors.subject_code + '</div>'); // add_new the actual error message under our input
                    }

                    // handle errors for lesson number ---------------
                    if (data.errors.subject_int_code) {
                        $('#subject_int_code_group').addClass('has-error'); // add_new the error class to show red input
                        $('#subject_int_code_group').append('<div class="help-block">' + data.errors.subject_int_code + '</div>'); // add_new the actual error message under our input
                    }


                } else {

                    // ALL GOOD! just show the success message!
                    $('#add_subject').append('<div class="alert alert-success">' + data.message + '</div>').trigger('reset');
                    $('#subject_list').append('<li class="list-group-item">' + data.subject_name + '</li>');
                    // usually after form submission, you'll want to redirect
                    // window.location = '/thank-you'; // redirect a user to another page
                }

            });

        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });




});