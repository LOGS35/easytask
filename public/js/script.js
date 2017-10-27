/*!
 * Start Bootstrap - SB Admin v4.0.0-beta (https://startbootstrap.com/template-overviews/sb-admin)
 * Copyright 2013-2017 Start Bootstrap
 * Licensed under MIT (https://github.com/BlackrockDigital/startbootstrap-sb-admin/blob/master/LICENSE)
 */
$(document).ready(function () {
    /* Usuarios */
    $(function () {
        $('.profile input[type="text"]').attr('disabled', 'disabled');
        $('.profile input[type="email"]').attr('disabled', 'disabled');
        $('.profile input[type="password"]').attr('disabled', 'disabled');
        $('.profile select').attr('disabled', 'disabled');
    });
    $('.profile .card-header i.fa.fa-pencil.btn.btn-primary').on('click', function () {
        if ($('.profile .card').hasClass('edit')) {
            $('.profile .card-header i.fa.fa-pencil.btn.btn-primary').parents('.card').removeClass('edit');
            $('.profile input[type="text"]').attr('disabled', 'disabled');
            $('.profile input[type="email"]').attr('disabled', 'disabled');
            $('.profile input[type="password"]').attr('disabled', 'disabled');
            $('.profile select').attr('disabled', 'disabled');
            $('.profile .password-confirm').fadeOut('fast');
            $('.profile .input-popover input[type="password"]').parent('.input-popover').parent('#error').parent('.col-md-12').removeClass('col-lg-6');
            $('.profile .input-popover input[type="password"]').val(contraseña);
            $('.profile .password-confirm input[type="password"]').val(contraseña);
            $('.profile .button-submit').fadeOut('fast');
        }
        else {
            $('.profile .card-header i.fa.fa-pencil.btn.btn-primary').parents('.card').addClass('edit');
            $('.profile input[type="text"]').removeAttr("disabled");
            $('.profile input[type="email"]').removeAttr("disabled");
            $('.profile select').removeAttr("disabled");
            $('.profile .button-submit').fadeIn('slow');
        }
    });
    $('.profile .input-popover').on('click', function () {
        if ($('.profile .card').hasClass('edit')) {
            $('.profile .input-popover input[type="password"]').removeAttr("disabled");
            $('.profile .input-popover input[type="password"]').parent('.input-popover').parent('#error').parent('.col-md-12').addClass('col-lg-6');
            $('.profile .input-popover input[type="password"]').val('');
            $('.profile .password-confirm input[type="password"]').val('');
            $('.profile .password-confirm input[type="password"]').removeAttr("disabled");
            $('.profile .password-confirm').fadeIn('slow');
        }
    });
    /* Usuarios FIN */
    /* find user ajax select */
    $(".js-example-theme-multiple").select2({
        minimumInputLength: 1
        , ajax: {
            url: 'user/find'
            , dataType: 'json'
            , data: function (params) {
                return {
                    q: $.trim(params.term)
                };
            }
            , processResults: function (data) {
                return {
                    results: data
                };
            }
            , cache: true
        }
    });
    /* Datatables */
        $('#users-table').DataTable({
            serverSide: true,
            processing: true,
            ajax: 'obteneruser',
            columns: [
                {data: 'id'},
                {data: 'name'},
                {data: 'lastname'},
                {data: 'type'},
                {data: 'email'}
                //{data: 'action', orderable: false, searchable: false}
            ]
        });
    $('#equipo-table').DataTable({
            serverSide: true,
            processing: true,
            ajax: 'obtenerequipo',
            columns: [
                {data: 'nombre'},
                {data: 'estado'},
                {data: 'created_at'},
                {data: 'action', orderable: false, searchable: false}
            ]
        });
});