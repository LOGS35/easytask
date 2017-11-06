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
});