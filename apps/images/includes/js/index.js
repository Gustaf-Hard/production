$(document).ready(function() {
    var concepts = [];
    var timer;







    $('#search_image').submit(function(event) {
        event.preventDefault();
        var query = $('input[name=query]').val();


        // POPULATE THE LESSON LIST
        $.getJSON("../../api/images/search/?search=" + query, function (data) {
            $('#image_area').html('');
            $.each(data, function () {
                console.log(root + "search/" + this.image_name);
                $('#image_area').append('<embed src="' + root + "search/" + this.image_name + '#zoom=10&scrollbar=1" width="530" height="375" type="application/pdf">');

            });
        });

    });




});

