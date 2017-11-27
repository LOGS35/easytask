<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $invoice }}</title>
    <style>
        .clearfix:after {
          content: "";
          display: table;
          clear: both;
        }

        a {
          color: #5D6975;
          text-decoration: underline;
        }

        body {
          position: relative;
          /*width: 21cm;  
          height: 29.7cm;*/ 
          margin: 0 auto; 
          color: #001028;
          background: #FFFFFF; 
          font-family: Arial, sans-serif; 
          font-size: 12px; 
          font-family: Arial;
        }

        header {
          padding: 10px 0;
          margin-bottom: 30px;
        }

        #logo {
          text-align: center;
          margin-bottom: 10px;
        }

        #logo img {
          width: 40%;
        }

        h1 {
          border-top: 1px solid  #5D6975;
          border-bottom: 1px solid  #5D6975;
          color: #5D6975;
          font-size: 2.4em;
          line-height: 1.4em;
          font-weight: normal;
          text-align: center;
          margin: 0 0 20px 0;
          background: url(dimension.png);
        }

        #project {
          float: left;
        }

        #project span {
          color: #5D6975;
          text-align: right;
          width: 52px;
          margin-right: 10px;
          display: inline-block;
          font-size: 0.8em;
        }

        #company {
          float: right;
          text-align: right;
        }

        #project div,
        #company div {
          white-space: nowrap;        
        }

        table {
          width: 100%;
          border-collapse: collapse;
          border-spacing: 0;
          margin-bottom: 20px;
        }

        table tr:nth-child(2n-1) td {
          background: #F5F5F5;
        }

        table th,
        table td {
          text-align: center;
        }

        table th {
          padding: 5px 20px;
          color: #5D6975;
          border-bottom: 1px solid #C1CED9;
          white-space: nowrap;        
          font-weight: normal;
        }

        table .service,
        table .desc {
          text-align: left;
        }

        table td {
          padding: 20px;
          text-align: right;
        }

        table td.service,
        table td.desc {
          vertical-align: top;
        }

        table td.unit,
        table td.qty,
        table td.total {
          font-size: 1.2em;
        }

        table td.grand {
          border-top: 1px solid #5D6975;;
        }

        #notices .notice {
          color: #5D6975;
          font-size: 1.2em;
        }

        footer {
          color: #5D6975;
          width: 100%;
          height: 30px;
          position: absolute;
          bottom: 0;
          border-top: 1px solid #C1CED9;
          padding: 8px 0;
          text-align: center;
        }  
    </style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="storage/logo.png">
      </div>
      <h1>{{ $invoice }}</h1>
      <div id="project">
        <div><span>Compañia</span> Digital Market</div>
        <div><span>Dirección</span> Av. Vallarta 1110, Americana, 44160 Guadalajara, Jal.</div>
        <div><span>Correo</span> <a href="easytask@gmail.com">digitalmarket@gmail.com</a></div>
        <div><span>Fecha</span> {{ $date }}</div>
        <div><span>Entre fechas:</span> {{ $entrefechas }}</div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">Nombre</th>
            <th class="desc">Apellidos</th>
            <th>Correo</th>
            <th>Tareas completadas</th>
          </tr>
        </thead>
        <tbody>
         @foreach ($task_count as $task)
          <tr>
            <td class="service">{{ $task->name }}</td>
            <td class="desc">{{ $task->lastname }}</td>
            <td class="unit">{{ $task->email }}</td>
            <td class="qty">{{ $task->task_complete }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </main>
    <footer>
      Copyright © Easy Task 2017
    </footer>
  </body>
</html>
