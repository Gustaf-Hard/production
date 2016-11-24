$(document).ready(function() {



    /*
     * LIST ALL ADDED LANGUAGE
     */
    $.getJSON(root + "api/languages/", function (data) {
        $.each(data, function () {
            $('#language_list').append('<li class="list-group-item">' + this.language_name + '</li>');
        });
    });


    function showAddLanguageForm(countryId, buttonId) {
        $(buttonId).click(function () {
            $('.country_language_add_btn').show();
            $(buttonId).hide();
            countryLanguageForm('#country_' + countryId, countryId);
        });
    }




    function countryLanguageForm(appendTo, countryId) {
        $('.add_country_language').hide();
        $(appendTo).append('<li class="list-group-item add_country_language" id="add_country_language" style="padding: 3px"><form class="form-inline country_language_form" id="add_country_language_form'+countryId+'"></form></li>');
        $('#add_country_language_form'+countryId).append('     <div class="form-group"  id="sel_country_language_group'+countryId+'"></div>');
        $('#sel_country_language_group'+countryId).append('<select class="form-control" id="sel_country_language'+countryId+'" name="country_langugae"> </select>');
        $.getJSON(root + "api/languages", function (data) {
            $.each(data, function () {
                $('#sel_country_language'+countryId).append('<option value="">'+this.language_name+'</option>');
            });
        });
        //$('#sel_country_language').append('<option value="">Test</option>');
        $('#add_country_language_form'+countryId).append('<button style="margin-left: 5px" type="submit" value="1" id="form_submit" class="btn btn-sm btn-success">Add</button>');
    }



    /*
     * POPULATE COUNTRY DROPDOWN IN FORM
     */
    $.getJSON(root + "api/countries/all/", function (data) {
        $.each(data, function () {
            $('#sel_country').append('<option value="' + this.alpha2Code + '">' + this.name + '</option>');
        });
    });


    /*
     * POPULATE LANGUAGE DROPDOWN IN FORM
     */
    $.getJSON(root + "api/languages/all/", function (data) {
        $.each(data, function (k,v) {
            $('#sel_language').append('<option value="' + k + '">' + v.name + '</option>');
        });
    });








    /**************************************
     * ADD NEW LANGUAGE
     * Process teh form
     */
    $('#add_language').submit(function(event) {
        $('.form-group').removeClass('has-error'); // remove the error class
        $('.help-block').remove(); // remove the error text

        // get the form data
        // there are many ways to get this data using jQuery (you can use the class or id also)
        var formData = {
            'language'                         : $('select[name=language]').val(),
        };

        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : root + 'api/languages/add_new/', // the url where we want to POST
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
                    if (data.errors.language) {
                        $('#sel_language_group').addClass('has-error'); // add_new the error class to show red input
                        $('#sel_language_group').append('<div class="help-block">' + data.errors.language + '</div>'); // add_new the actual error message under our input
                    }
                } else {
                    // ALL GOOD! just show the success message!
                    $('#add_language').append('<div class="alert alert-success">' + data.message + '</div>').trigger('reset');
                    $('#language_list').append('<li class="list-group-item">' + data.language_name + '</li>');
                    // usually after form submission, you'll want to redirect
                    // window.location = '/thank-you'; // redirect a user to another page
                }

            });

        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });




});