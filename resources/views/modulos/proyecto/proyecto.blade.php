@extends('layouts.app')

@section('content')
<div class="content-wrapper profile">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ route('home') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Proyectos</li>
      </ol>
      <!-- Acciones -->
      @if (Auth::user()->type == "Scrum Master")
          <div class="card mb-3">
              <div class="card-header">
                  <i class="fa fa-cog fa-fw" aria-hidden="true"></i>Acciones
              </div>
              <div class="card-body">
                    <a href="" class="btn btn-success" data-toggle="modal" data-target="#crearteam">Crear proyecto <i class="fa fa-plus fa-fw" aria-hidden="true"></i></a>
              </div> 
          </div>
      @endif
      <!-- Table equipo -->
      <!-- Example DataTables Card-->
      <div class="card mb-3-equip">
        <div class="card-header">
          <i class="fa fa-fw fa-users" aria-hidden="true"></i>Proyectos</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="proyecto-table" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <!--<th>ID</th>-->
                  <th>Nombre del proyecto</th>
                  <th>Descripción</th>
                  <th>Estado</th>
                  <th>Fecha de creación</th>
                  <th>Acción</th>
                </tr>
              </thead>
            </table>
          </div>
          <!--$users->links() 
          $users->render()-->
        </div>
      </div>
    </div>
    <!-- /.container-fluid-->
</div>
    <!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="crearteam" role="dialog" aria-labelledby="crearteam" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="crearteam">Crear proyecto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['route' => 'proyecto.store', 'method' => 'POST']) !!}
        <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
               {!! Form::label('name', 'Nombre') !!}
               {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre', 'required']) !!}
              </div>
              <div class="col-md-6">
               {!! Form::label('estado', 'Estado') !!}
               {!! Form::select('estado', ['En proceso' => 'En proceso', 'Incompleto' => 'Incompleto', 'Detenido' => 'Detenido'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione', 'required']) !!}
              </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
               {!! Form::label('description', 'Descripción') !!}
               {!! Form::textarea('description', null, ['size' => '5x5','class' => 'form-control', 'placeholder' => 'Descripción', 'required']) !!}
              </div>
            </div>
        </div>
        <div class="form-group">
                {!! Form::label('equipo', 'Equipo') !!}
                <select class="js-example-basic-single form-control" name="equipo" id="equipo" required></select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Crear proyecto</button>
      </div>
              {!! Form::close() !!}
    </div>
  </div>
</div>
<!-- Modal confirm -->
<div class="modal fade" id="elimmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¿Esta seguro que desea eliminar este proyecto?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        El proyecto se eliminará completamente de la base de datos
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <a class="btn btn-primary">Eliminar</a>
      </div>
    </div>
  </div>
</div>
@endsection
