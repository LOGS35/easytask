$(document).ready(function () {
    
dragula([
	document.getElementById('pendiente'),
	document.getElementById('revision'),
	document.getElementById('aprobado'),
    document.getElementById('1'),
    document.getElementById('2'),
    document.getElementById('3'),
    document.getElementById('4'),
    document.getElementById('5'),
    document.getElementById('6'),
    document.getElementById('7'),
    document.getElementById('8'),
])

.on('drag', function(el) {
	
	// add 'is-moving' class to element being dragged
	el.classList.add('is-moving');
})
.on('dragend', function(el) {
	
	// remove 'is-moving' class from element after dragging has stopped
	el.classList.remove('is-moving');
	
	// add the 'is-moved' class for 600ms then remove it
	window.setTimeout(function() {
		el.classList.add('is-moved');
		window.setTimeout(function() {
			el.classList.remove('is-moved');
		}, 600);
	}, 100);
    //el.classList.add('aqui');
    if ($(el).parent().hasClass('users-columns')) {
        //$(el).data('id_user',$(el).parent().data('id_usuario'));
        //console.log($(el).parent().data('id_usuario'));
        $(el).attr('data-id_user',$(el).parent().data('id_usuario'));
         var parametros = {
            "id_task" : el.dataset.id_task,
            "id_user" : el.dataset.id_user,
            "estado"  : 'BackLog Usuario',
            "dia"     : null,
        };
    } else if ($(el).parent().hasClass('pendientes')) {
        $(el).attr('data-id_user',null);
        var parametros = {
            "id_task" : el.dataset.id_task,
            "id_user" : null,
            "estado"  : 'BackLog Proyecto',
            "dia"     : null,
        };
               
    } else if ($(el).parent().hasClass('revisiones')) {
        var parametros = {
            "id_task" : el.dataset.id_task,
            "id_user" : el.dataset.id_user,
            "estado"  : 'BackLog Revision',
            "dia"     : null,
        };
               
    } else if ($(el).parent().hasClass('aprobadas')) {
            var parametros = {
            "id_task" : el.dataset.id_task,
            "id_user" : el.dataset.id_user,
            "estado"  : 'BackLog Aprobado',
            "dia"     : 'today',
            };   
    }
   
    
    $.ajax({
              data:  parametros, //datos que se envian a traves de ajax
              url:   '/taskmodify', //archivo que recibe la peticion
              type:  'get', //método de envio
              beforeSend: function () {
                //$("#resultado_comments").html("Procesando, espere por favor...");
                  //$('.card-header').html('procesando');
              },
              success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                //$("#resultado_comments").html(response);
                  //console.log(response);
                  //$('#old_comments').load($pathname+' #coment-ajax');
                  //$('input#message').val('');
                  //$('#content-message').scrollTop(9999);
                  //$('input#message').focus();
                  console.log(parametros);
                  console.log(response);
              }
            });
    //id_task
});

});