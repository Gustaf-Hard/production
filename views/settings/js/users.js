$(document).ready(function() {



    /*
     * LIST ALL ADDED USERS
     */
    $.getJSON(root + "api/users/", function (data) {
        $.each(data, function () {

            $('#users_list').append('<a class="list-group-item user_item" id="user_item' + this.id  + '"><p><strong> ' + this.name + '</strong></p></a>');

            var name = this.name;

            $('#user_item' + this.id ).click(function(){

                // Add users full name
                $('#profile_user_fullname').html(name);
                
            });
        });
    });


});