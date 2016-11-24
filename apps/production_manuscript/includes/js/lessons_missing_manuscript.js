$(document).ready(function() {

    $.getJSON("includes/api/LessonsMissingManuscript.php", function (data) {
        $.each(data, function () {
            $('#lesson_list').append('<a class="list-group-item lesson_item" id="lesson_item' + this.id  + '"><p><strong> ' + this.subject_code + this.lesson_number + '</strong></p><p><small>' + this.lesson_name + '</small> </p> <span id="lesson_id" style="display: none">' + this.id + '</span></a>');
            var id = this.id;
            var lesson_name = this.lesson_name;
            var lesson_subject = this.subject_code;
            var lesson_number = this.lesson_number;
            $('#lesson_item' + this.id ).click(function(){
                $("#form_area").show();
                $('input[name=lesson_id]').val(id);
                form_header.innerText = "Add manuscript for [" + lesson_subject + lesson_number + "] " + lesson_name;
                console.log(id);
            });
        });
    });

});

