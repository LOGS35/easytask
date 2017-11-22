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
    $('#proyecto_status').on('change', function(e) {
        $estado = $(this).val();
        $('#cuerpobody').load('?estado='+$estado+' #cuerpoajax');
        
        //console.log($(this).val());
    });
    /* comentarios */
    $('input#message').keyup(function(e){
        if(e.keyCode == 13)
        {
            $('#submit-comment').focus();
        }
    });
    
    $('#submit-comment').on('click', function(e) {
        $pathname = window.location.pathname;
        //$('#resultado_comments p').appendTo('#old_comments');
        var parametros = {
                "comentario" : $('input#message').val(),
                "id_user" : $(this).data('id_user'),
                "id_proy" : $(this).data('id_proy')
        };
        $.ajax({
              data:  parametros, //datos que se envian a traves de ajax
              url:   '/comments/add_comments_proyect', //archivo que recibe la peticion
              type:  'get', //método de envio
              beforeSend: function () {
                //$("#resultado_comments").html("Procesando, espere por favor...");
              },
              success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                //$("#resultado_comments").html(response);
                  //console.log(response);
                  $('#old_comments').load($pathname+' #coment-ajax');
                  $('input#message').val('');
                  $('input#message').focus();
              }
            });
        //$('#resultado_comments').load('/comments/add_comments_proyect #resultado_comments');
    });
});