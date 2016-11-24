$(document).ready(function() {
    $('a').css('cursor', 'pointer');

    if (typeof(page_name) != "undefined" && page_name !== null) {
        $('#page-title')
            .css("background-color", "#31b0d5")
            .text(page_name);
    }




    $.getJSON(root + "api/apps/menu/", function (data) {
        $.each(data, function () {
            $('#main_navigation').append(
                '<ul class="nav navbar-nav" id="main_navigation">' +
                    '<li class="dropdown">' +
                        '<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' +
                            this.menu_name +
                        '<span class="caret"></span></a>' +
                        '<ul class="dropdown-menu" id="sub_menu_' + this.menu_name + '">'+
                        '</ul></li></ul>'
            );
            var app_name = this.menu_name;
            $.each(this.sub_menu, function () {
                if(this.app_name == '-'){
                    $('#sub_menu_' + app_name).append('<li role="separator" class="divider"></li>');
                } else{
                    $('#sub_menu_' + app_name).append('<li class="' + this.disabled + '"><a href="' + root + this.url + '" >' + this.app_name + '</a></li>');
                }
            });
        });
    });
});
