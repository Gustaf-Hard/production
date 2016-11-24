$(document).ready(function() {




    /*
     * LIST ALL ADDED COUNTRIES
     */
    $.getJSON(root + "api/countries/languages", function (data) {
        $.each(data, function () {
            var country_id = this.id;
            $('#country_list').append('<li class="list-group-item" id="country_' + country_id + '">' + this.country_name + '</li>');
            $.each(this.languages, function () {
                $('#country_' + country_id).append('<br><span class="label label-primary">' + this.language_name + '</span>');
            });
            $('#country_' + country_id).append('<br><a href="#" class="country_language_add_btn" id="add_language_country_for_' + country_id + '" class="small"> [+] Add language</a>');
            showAddLanguageForm(country_id, '#add_language_country_for_' + country_id);

        });
    });





    /**************************************
     * ADD NEW COUNTRY
     * Process teh form
     */
    $('#add_country').submit(function(event) {
        $('.form-group').removeClass('has-error'); // remove the error class
        $('.help-block').remove(); // remove the error text

        // get the form data
        // there are many ways to get this data using jQuery (you can use the class or id also)
        var formData = {
            'country'                         : $('select[name=country]').val(),
        };

        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : root + 'api/countries/add_new/', // the url where we want to POST
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
                    if (data.errors.country) {
                        $('#sel_country_group').addClass('has-error'); // add_new the error class to show red input
                        $('#sel_country_group').append('<div class="help-block">' + data.errors.country + '</div>'); // add_new the actual error message under our input
                    }

                } else {

                    // ALL GOOD! just show the success message!
                    $('#add_country').append('<div class="alert alert-success">' + data.message + '</div>').trigger('reset');
                    $('#country_list').append('<li class="list-group-item">' + data.country_name + '</li>');
                    // usually after form submission, you'll want to redirect
                    // window.location = '/thank-you'; // redirect a user to another page
                }

            });

        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });








});