@extends('layouts.app')

@section('content')
<div class="content-wrapper profile">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Equipos</li>
      </ol>
      <!-- Acciones -->
      @if (Auth::user()->type == "Scrum Master")
          <div class="card mb-3">
              <div class="card-header">
                  <i class="fa fa-cog fa-fw" aria-hidden="true"></i>Acciones
              </div>
              <div class="card-body">
                    <a href="" class="btn btn-success" data-toggle="modal" data-target="#crearteam">Crear equipo</a>
              </div> 
          </div>
      @endif
      <!-- Table equipo -->
      <!-- Example DataTables Card-->
      <div class="card mb-3-equip">
        <div class="card-header">
          <i class="fa fa-fw fa-users" aria-hidden="true"></i>Equipos</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <!--<th>ID</th>-->
                  <th>Nombre</th>
                  <th>Estado</th>
                  <th>Fecha de creación</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <!--<th>ID</th>-->
                  <th>Nombre</th>
                  <th>Estado</th>
                  <th>Fecha de creación</th>
                  <th>Acción</th>
                </tr>
              </tfoot>
              <tbody>
                @foreach($equipo as $equipo)
                    <tr>
                      <!--<td>{{ $equipo->id }}</td>-->
                      <td>{{ $equipo->nombre }}</td>
                      <td>
                         @if ($equipo->estado == "Activo")
                          <span class="badge badge-success">{{ $equipo->estado }}</span>
                         @endif
                         @if ($equipo->estado == "Inactivo")
                          <span class="badge badge-warning">{{ $equipo->estado }}</span>
                         @endif
                      </td>
                      <td>{{ $equipo->created_at }}</td>
                      <td>
                         @if ($equipo->estado == "Activo")
                          <a href="{{ route('equip.destroy', $equipo->id) }}" class="badge badge-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                         @endif 
                         <a href="{{ route('equip.show', $equipo->id) }}" class="badge badge-success"><i class="fa fa-eye" aria-hidden="true"></i></a>
                      </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!--$users->links() 
          $users->render()-->
        </div>
        <div class="card-footer small text-muted">Ultima actualización {{ $equipo->created_at }}</div>
      </div>
    </div>
    <!-- /.container-fluid-->
</div>
    <!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="crearteam" tabindex="-1" role="dialog" aria-labelledby="crearteam" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="crearteam">Crear equipo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['route' => 'equip.store', 'method' => 'POST']) !!}
        <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
               {!! Form::label('nombre', 'Nombre') !!}
               {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre', 'required']) !!}
              </div>
              <!--<div class="col-md-6">
               {!! Form::label('estado', 'Estado') !!}
               {!! Form::select('estado', ['' => 'Seleccione', 'Activo' => 'Activo', 'Inactivo' => 'Inactivo'], null, ['class' => 'form-control']) !!}
              </div>-->
            </div>
        </div>
        <div class="form-group">
                {!! Form::label('usuarios', 'Usuarios') !!}
                <select class="js-example-theme-multiple form-control" name="user[]" multiple="multiple"></select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Crear equipo</button>
      </div>
              {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection
