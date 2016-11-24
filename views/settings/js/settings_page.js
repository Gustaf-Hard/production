
$(document).ready(function() {
    var menu_alternatives = ['users', 'languages', 'subjects', 'countries'];



    // Print out the menu
    $('#settings_navigation').html('');
    $.each(menu_alternatives, function(){
        $('#settings_navigation').append(
            '<li role="presentation">' +
            '<a id="' + this + '_button"  class="settings_menu_item" data-settingsmenu="user" style="cursor: pointer;">' + this + '</a>' +
            '</li>'
        );

        showContent(this); // Show content on click
    });


    // Make button active on click
    $('.nav.nav-tabs > li').on('click', function() {
        $(this).addClass('active');
        $(this).siblings().removeClass('active');
    });

    // Add some styles to the menu
    $('.settings_menu_item').css({cursor: 'pointer', textTransform : 'capitalize'});



    // Makes the content to show if it is in the menu_alternative and
    function showContent(menuButtonId) {
        $('#' + menuButtonId + '_button').click(function () {
            $('.content_settings').hide();
            $('#' + menuButtonId + '_settings').show();
        });
    }





   





























});