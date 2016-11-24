$(document).ready(function() {


    $.getJSON("../../api/subject/", function (data) {
        $('#lesson_subject').append('<option value="0"></option>');
        $.each(data, function () {
            $('#lesson_subject').append('<option value="' + this.subject_code + '">' + this.subject_code + '</option>');
        });
    });


    // process the add_new new lesson form 
    $('#add_lesson').submit(function(event) {


        $('.form-group').removeClass('has-error'); // remove the error class
        $('.help-block').remove(); // remove the error text

        // get the form data
        // there are many ways to get this data using jQuery (you can use the class or id also)
        var formData = {
            'lesson_subject'                    : $('select[name=lesson_subject]').val(),
            'lesson_number'                     : $('input[name=lesson_number]').val(),
            'lesson_name'                       : $('input[name=lesson_name]').val(),
        };

        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'includes/process_form.php', // the url where we want to POST
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
                    if (data.errors.lesson_subject) {
                        $('#lesson_subject_group').addClass('has-error'); // add_new the error class to show red input
                        $('#lesson_subject_group').append('<div class="help-block">' + data.errors.lesson_subject + '</div>'); // add_new the actual error message under our input
                    }

                    // handle errors for lesson number ---------------
                    if (data.errors.lesson_number) {
                        $('#lesson_number_group').addClass('has-error'); // add_new the error class to show red input
                        $('#lesson_number_group').append('<div class="help-block">' + data.errors.lesson_number + '</div>'); // add_new the actual error message under our input
                    }

                    // handle errors for lesson number ---------------
                    if (data.errors.lesson_number2) {
                        $('#lesson_number_group').addClass('has-error'); // add_new the error class to show red input
                        $('#lesson_number_group').append('<div class="help-block">' + data.errors.lesson_number2 + '</div>'); // add_new the actual error message under our input
                    }

                    // handle errors for superhero lesson name ---------------
                    if (data.errors.lesson_name) {
                        $('#lesson_name_group').addClass('has-error'); // add_new the error class to show red input
                        $('#lesson_name_group').append('<div class="help-block">' + data.errors.lesson_name + '</div>'); // add_new the actual error message under our input
                    }

                } else {

                    // ALL GOOD! just show the success message!
                    $('#add_lesson').append('<div class="alert alert-success">' + data.message + '</div>').trigger('reset');
                    $('#list_added_lessons').prepend('<a href="#" class="list-group-item"><p><strong> ' + data.subject_code + data.lesson_number +'</strong></p><p>' + data.lesson_name + ' </p> <p><small> Added at: ' + data.created_at + ' </small></p></a>');

                    // usually after form submission, you'll want to redirect
                    // window.location = '/thank-you'; // redirect a user to another page

                }




            });

        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });

});