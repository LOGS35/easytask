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
    var parametros = {
        "id_task" : el.dataset.id_task,
        "id_user" : 'asd',
        "id_proy" : 'dsa'
    };
    console.log(parametros);
    //id_task
});

});