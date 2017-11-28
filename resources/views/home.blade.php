@extends('layouts.app')

@section('content')
<div class="content-wrapper mb-3-equip">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item active">
          <a href="#">Dashboard</a>
        </li>
       <!--  <li class="breadcrumb-item active">Mi Tablero</li> -->
      </ol>
      <!-- Acciones -->
      @if (Auth::user()->type == "Scrum Master")
          <div class="card mb-3">
              <div class="card-header">
                  <i class="fa fa-cog fa-fw" aria-hidden="true"></i>Acciones
              </div>
              <div class="card-body">
                   <div class="row">
                    <div class="col-md-4"><select class="js-example-basic-single form-control" name="proyecto" id="proyecto" required></select></div>
                    <div class="col-md-4">
                        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#rendimientoreport">Reporte de rendimiento <i class="fa fa-plus fa-fw" aria-hidden="true"></i></a></div>
                        </div>
              </div> 
          </div>
      @endif
      <!-- Icon Cards-->
      <div class="row">
        <div class="col-xl-6 col-sm-6 mb-3">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-newspaper-o"></i>
              </div>
              <div class="mr-5">{{ $cantidad }} Nuevas noticias!</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{ route('noticia.index') }}">
              <span class="float-left">Ver detalles</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        @if (Auth::user()->id_equip != null) 
        <div class="col-xl-6 col-sm-6 mb-3">
          <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-list"></i>
              </div>
              <div class="mr-5">{{ $taskcount }} Nuevas tareas en el proyecto: {{ $id_proyecto->name }}</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{ route('proyecto.show',$id_proyecto->id) }}">
              <span class="float-left">Ver detalles</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        @endif
        <!--<div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-support"></i>
              </div>
              <div class="mr-5">13 New Tickets!</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-left">Ver detalles</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>-->
      </div>
      @if (Auth::user()->id_equip != null) 
      <!-- Area Chart Example-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-area-chart"></i> Proceso del proyecto</div>
          <div id="char-complete">
            <div class="card-body" id="body-complete">
          <canvas id="myAreaCharts" width="100%" height="30"></canvas>
            </div>
            </div>
        <!-- <div class="card-footer small text-muted">Creado: {{ Carbon\Carbon::parse($id_proyecto->created_at)->format('Y-m-d \a \l\a\s H:i:s') }}</div> -->
      </div>
      <div class="row">
        <div class="col-lg-8">
          <!-- Example Bar Chart Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-bar-chart"></i> Proyectos finalizados</div>
              <canvas id="myBarCharts" width="100" height="50"></canvas>
            <!--<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>-->
          </div>
        </div>
        <div class="col-lg-4">
          <!-- Example Pie Chart Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-pie-chart"></i> Tareas del proyecto</div>
                      <div id="char-task">
            <div class="card-body" id="body-task">
              <canvas id="myPieCharts" width="100%" height="100"></canvas>
            </div>
              </div>
            <!-- <div class="card-footer small text-muted">Creado: {{ Carbon\Carbon::parse($id_proyecto->created_at)->format('Y-m-d \a \l\a\s H:i:s') }}</div> -->
          </div>
        </div>
      </div>
      @endif
      <!-- noticias -->
      <div class="mb-0 mt-4">
            <i class="fa fa-newspaper-o"></i> Últimas noticias</div>
          <hr class="mt-2">
          <div class="card-columns">
          @foreach($noticias as $noticia)
          <div class="card mb-3">
              <a href="{{ route('noticia.show',$noticia->noticia_id) }}">
                <img class="card-img-top img-fluid w-100" src="{{ route('storage',$noticia->image) }}" alt="">
              </a>
              <div class="card-body">
                <h6 class="card-title mb-1"><a href="{{ route('noticia.show',$noticia->noticia_id) }}">{{ str_limit($noticia->title, 80) }}</a></h6>
                <p class="card-text small">
                    Enviado por: <a href="{{ route('users.show',$noticia->user_id) }}">{{ $noticia->name.' '.$noticia->lastname }}</a>
                </p>
              </div>
              <hr class="my-0">
              <div class="card-footer small text-muted">Fecha de creación: {{ Carbon\Carbon::parse($noticia->fecha)->format('d-m-Y \a \l\a\s H:i:s') }}</div>
            </div>
        @endforeach
        </div>
    </div>
  </div>
      <!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="rendimientoreport" role="dialog" aria-labelledby="crearteam" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="crearteam">Crear reporte de rendimiento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['route' => 'pdf.proyecto', 'method' => 'POST']) !!}
        <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
               {!! Form::label('date_ini', 'Fecha inicial') !!}
               {!! Form::date('date_ini', null, ['class' => 'form-control', 'required']) !!}
              </div>
              <div class="col-md-6">
               {!! Form::label('date_ini', 'Fecha final') !!}
               {!! Form::date('date_fin', null, ['class' => 'form-control', 'required']) !!}
              </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Crear reporte</button>
      </div>
              {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection
@section('script')
<script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('js/sb-admin-charts.js') }}"></script>
@endsection
