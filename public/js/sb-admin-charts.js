$(document).ready(function () {
// Chart.js scripts
// -- Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

$.ajax({
    //data:  parametros, //datos que se envian a traves de ajax
    url:   'grafics/grafica1', //archivo que recibe la peticion
    type:  'get', //método de envio
    beforeSend: function () {
        //$("#resultado_comments").html("Procesando, espere por favor...");
    },
    success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
        // -- Area Chart Example
        //console.log(response.foo);
        console.log(response);
        var ctx = document.getElementById("myAreaCharts");
        var myLineChart = new Chart(ctx, {
          type: 'line',
          data: {
            labels: ["Hoy", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"],
            datasets: [{
              label: "Tareas completas",
              lineTension: 0.3,
              backgroundColor: "rgba(2,117,216,0.2)",
              borderColor: "rgba(2,117,216,1)",
              pointRadius: 5,
              pointBackgroundColor: "rgba(2,117,216,1)",
              pointBorderColor: "rgba(255,255,255,0.8)",
              pointHoverRadius: 5,
              pointHoverBackgroundColor: "rgba(2,117,216,1)",
              pointHitRadius: 20,
              pointBorderWidth: 2,
              data: [response.hoy, response.lunes, response.martes, response.miercoles, response.jueves, response.viernes, response.sabado, response.domingo],
            }],
          },
          options: {
            scales: {
              xAxes: [{
                time: {
                  unit: 'date'
                },
                gridLines: {
                  display: false
                },
                ticks: {
                  maxTicksLimit: 7
                }
              }],
              yAxes: [{
                ticks: {
                  min: 0,
                  max: 10,
                  maxTicksLimit: 5
                },
                gridLines: {
                  color: "rgba(0, 0, 0, .125)",
                }
              }],
            },
            legend: {
              display: false
            }
          }
        });
    }
});
    
$.ajax({
    //data:  parametros, //datos que se envian a traves de ajax
    url:   'grafics/grafica3', //archivo que recibe la peticion
    type:  'get', //método de envio
    beforeSend: function () {
        //$("#resultado_comments").html("Procesando, espere por favor...");
    },
    success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve   
        // -- Bar Chart Example
        var ctx = document.getElementById("myBarCharts");
        var myLineChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
            datasets: [{
              label: "Proyectos completados",
              backgroundColor: "rgba(2,117,216,1)",
              borderColor: "rgba(2,117,216,1)",
              data: [response.uno, response.dos, response.tres, response.cuatro, response.cinco, response.seis, response.siete, response.ocho, response.nueve, response.diez, response.once, response.doce],
            }],
          },
          options: {
            scales: {
              xAxes: [{
                time: {
                  unit: 'month'
                },
                gridLines: {
                  display: false
                },
                ticks: {
                  maxTicksLimit: 6
                }
              }],
              yAxes: [{
                ticks: {
                  min: 0,
                  max: 10,
                  maxTicksLimit: 5
                },
                gridLines: {
                  display: true
                }
              }],
            },
            legend: {
              display: false
            }
          }
        });
        }
});
    
$.ajax({
    //data:  parametros, //datos que se envian a traves de ajax
    url:   'grafics/grafica2', //archivo que recibe la peticion
    type:  'get', //método de envio
    beforeSend: function () {
        //$("#resultado_comments").html("Procesando, espere por favor...");
    },
    success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve    
// -- Pie Chart Example
        var ctx = document.getElementById("myPieCharts");
        var myPieChart = new Chart(ctx, {
          type: 'pie',
          data: {
            labels: ["Completado", "Por completar"],
            datasets: [{
              data: [response.task_count_total, response.task_count_terminado],
              backgroundColor: ['#007bff', '#dc3545'],
            }],
          },
        });
    }
});
    
    });
