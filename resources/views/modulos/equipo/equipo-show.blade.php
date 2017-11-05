@extends('layouts.app')

@section('content')
<div class="content-wrapper equipo-show">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ route('home') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
          <a href="{{ route('equipo.index') }}">Equipos</a>
        </li>
        <li class="breadcrumb-item active">{{ $equipo->nombre }}</li>
      </ol>
      <!-- Info -->
      <div class="card mb-3">
          <div class="card-header">
              <i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>Información del equipo
          </div>
          <div class="card-body">
                <div class="estado">
                    <p class="badge badge-danger">Nombre: {{ $equipo->nombre }}</p>
                </div>
                <div class="estado">
                    @if ($equipo->estado == "Activo")
                        <p class="badge badge-success">Estado: {{ $equipo->estado }}</p>
                    @endif 
                    @if ($equipo->estado == "Inactivo")
                      <p class="badge badge-warning">Estado: {{ $equipo->estado }}</p>
                    @endif 
                </div>
                <div class="estado">
                    <p class="badge badge-info">Fecha de creación: {{ Carbon\Carbon::parse($equipo->created_at)->format('d-m-Y') }}</p>
                </div>
                <div class="estado">
                    <p class="badge badge-info">Última modificación: {{ Carbon\Carbon::parse($equipo->update_at)->format('d-m-Y') }}</p>
                </div>
          </div>
      </div>
      <!-- Acciones -->
      @if (Auth::user()->type == "Scrum Master")
          <div class="card mb-3">
              <div class="card-header">
                  <i class="fa fa-cog fa-fw" aria-hidden="true"></i>Acciones para el equipo: {{ $equipo->nombre }}
              </div>
              <div class="card-body">
                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#editeam">Editar equipo<i class="fa fa-pencil fa-fw" aria-hidden="true"></i></a>
                    <a href="#" data-toggle="modal" data-target="#eliteam" class="btn btn-danger">Desactivar equipo <i class="fa fa-trash" aria-hidden="true"></i></a>
              </div> 
          </div>
      @endif
      <!-- Table equipo -->
      <!-- Example DataTables Card-->
      <div class="card mb-3-equip">
        <div class="card-header">
          <i class="fa fa-fw fa-users" aria-hidden="true"></i>Integrantes</div>
        <div class="card-body">
         <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Puesto</th>
                  <th>Correo</th>
                  <th>Fecha de creación</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <!--<tfoot>
                <tr>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Integrantes</th>
                  <th>Estado</th>
                  <th>Fecha de creación</th>
                  <th>Acción</th>
                </tr>
              </tfoot>-->
              <tbody>
                @foreach($users as $user)
                    <tr>
                      <td>{{ $user->name }} {{ $user->lastname }}</td>
                      <td>
                         @if ($user->type == "Scrum Master")
                          <span class="badge badge-danger">{{ $user->type }}</span>
                         @endif 
                         @if ($user->type == "Project Owner")
                          <span class="badge badge-primary">{{ $user->type }}</span>
                         @endif 
                         @if ($user->type == "Developer")
                          <span class="badge badge-info">{{ $user->type }}</span>
                         @endif 
                      </td>
                      <td>{{ $user->email }}</td>
                      <td>{{ Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}</td>
                      <td> @if (Auth::user()->type == "Scrum Master")
                           <a data-href="{{ route('equipo.expulsar', $user->id) }}" class="badge badge-danger"><i class="fa fa-user-times" aria-hidden="true"></i></a>
                          @endif 
                       <a href="{{ route('users.show', $user->id) }}" class="badge badge-success"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                    </tr>
                @endforeach
              </tbody>
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
<div class="modal fade bd-example-modal-lg" id="editeam" tabindex="-1" role="dialog" aria-labelledby="crearteam" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="crearteam">Crear equipo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['route' => ['equipo.update', $equipo->id], 'method' => 'PUT']) !!}
        <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
               {!! Form::label('nombre', 'Nombre') !!}
               {!! Form::text('nombre', $equipo->nombre, ['class' => 'form-control', 'placeholder' => 'Nombre', 'required']) !!}
              </div>
              <!--<div class="col-md-6">
               {!! Form::label('estado', 'Estado') !!}
               {!! Form::select('estado', ['' => 'Seleccione', 'Activo' => 'Activo', 'Inactivo' => 'Inactivo'], null, ['class' => 'form-control']) !!}
              </div>-->
            </div>
        </div>
        <div class="form-group">
                {!! Form::label('usuarios', 'Agregar integrante') !!}
                <select class="js-example-theme-multiple form-control" name="user[]" multiple="multiple"></select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Actualizar</button>
      </div>
              {!! Form::close() !!}
    </div>
  </div>
</div>
<!-- Modal confirm -->
<div class="modal fade" id="eliteam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¿Esta seguro que desea desactivar el equipo?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        El equipo {{ $equipo->nombre }} pasara a modo "inactivo" y todos los miembros del equipo serán expulsados
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <a href="{{ route('equipo.destroy', $equipo->id) }}" class="btn btn-primary">Desactivar equipo</a>
      </div>
    </div>
  </div>
</div>
<!-- Modal confirm -->
<div class="modal fade" id="elimmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¿Esta seguro que desea expulsar a esta persona del equipo?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        El miembro se quedara fuera del equipo
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <a class="btn btn-primary">Expulsar</a>
      </div>
    </div>
  </div>
</div>
@endsection
