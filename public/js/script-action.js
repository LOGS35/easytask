/*!
 * Start Bootstrap - SB Admin v4.0.0-beta (https://startbootstrap.com/template-overviews/sb-admin)
 * Copyright 2013-2017 Start Bootstrap
 * Licensed under MIT (https://github.com/BlackrockDigital/startbootstrap-sb-admin/blob/master/LICENSE)
 */
$(document).ready(function () {
    $(document).on('click', 'table a.badge.badge-danger',function (e) {
        $('#elimmodal').modal('toggle');
        //console.log($(this).data('href'));
        $('#elimmodal').find('.btn.btn-primary').attr("href",$(this).data('href'));
    });
    $(document).on('click', '.exit-team .btn.btn-danger',function (e) {
        $('#elimmodal').modal('toggle');
        //console.log($(this).data('href'));
        $('#elimmodal').find('.btn.btn-primary').attr("href",$(this).data('href'));
    });
    $('#menumovil').on('click', function(e) {
        $($(this).data('target')).toggle("slow");
    });
    $('.dropdown').on('click', function(e) {
        /*$($('.dropdown').data('target')).addClass('collapsed');
        $($('.dropdown').data('target')).toggle("slow");*/
        
        if ($(this).hasClass('collapsed')) {
            $($(this).data('target')).toggle("slow");
            $(this).removeClass('collapsed');
        } else {
            $($(this).data('target')).toggle("slow");
            $(this).addClass('collapsed');
        }
    });
    $(document).on('click', '.card-body',function (e) {
        $('label select').removeAttr("disabled");
    });
});