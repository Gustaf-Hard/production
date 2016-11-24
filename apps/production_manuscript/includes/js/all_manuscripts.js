$(document).ready(function() {

    $.getJSON("includes/api/all_manuscripts.php", function (data) {
        $.each(data, function () {
            $('#lesson_list').append('<a class="list-group-item lesson_item" id="lesson_item' + this.id  + '"><p><strong> ' + this.subject_code + this.lesson_number + '</strong></p><p><small>' + this.lesson_name + ' </small></p><span id="lesson_id" style="display: none">' + this.id + '</span></a>');
            var id = this.id;
            var lesson_name = this.lesson_name;
            var lesson_subject = this.subject_code;
            var code = this.subject_code + this.lesson_number;
            var lesson_number = this.lesson_number;
            var manuscript_url = this.manuscript_url;
            var manuscript_text = this.manuscript_text;
            var created_at = this.created_at;
            $('#lesson_item' + this.id ).click(function(){
                $("#form_area").show();
                $('#manuscript_iframe').attr('src', manuscript_url);
                $('input[name=lesson_id]').val(id);
                lesson_name_header.innerText = lesson_name;
                lesson_code_header.innerText = code;
                lesson_date_created.innerText = created_at;
                console.log(manuscript_url);
            });
        });
    });

});

