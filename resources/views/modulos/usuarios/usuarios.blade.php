@extends('layouts.app')

@section('content')
<div class="content-wrapper profile">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Usuarios</li>
      </ol>
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
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Integrantes</th>
                  <th>Estado</th>
                  <th>Fecha de creación</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Integrantes</th>
                  <th>Estado</th>
                  <th>Fecha de creación</th>
                  <th>Acción</th>
                </tr>
              </tfoot>
              <tbody>
                @foreach($users as $user)
                    <tr>
                      <td>{{ $user->id }}</td>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->lastname }}</td>
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
                      <td>holo</td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!--$users->links() 
          $users->render()-->
        </div>
        <div class="card-footer small text-muted">Ultima actualización {{ $user->created_at }}</div>
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
        {!! Form::open(['route' => ['profile.update', Auth::user()->id], 'method' => 'PUT']) !!}
        
        {!! Form::close() !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Crear equipo</button>
      </div>
    </div>
  </div>
</div>
@endsection