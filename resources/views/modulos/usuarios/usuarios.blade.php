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
      <!-- Acciones -->
      @if (Auth::user()->type == "Scrum Master")
          <div class="card mb-3">
              <div class="card-header">
                  <i class="fa fa-cog fa-fw" aria-hidden="true"></i>Acciones
              </div>
              <div class="card-body">
                    
              </div> 
          </div>
      @endif
      <!-- Table equipo -->
      <!-- Example DataTables Card-->
      <div class="card mb-3-equip">
        <div class="card-header">
          <i class="fa fa-fw fa-users" aria-hidden="true"></i>Usuarios</div>
        <div class="card-body">
            <table id="users-table" class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Puesto</th>
                    <th>Correo</th>
                    <th>Acción</th>
                </tr>
                </thead>
            </table>
          <!--$users->links() 
          $users->render()-->
        </div>
      </div>
    </div>
    <!-- /.container-fluid-->
</div>
    <!-- Modal -->
<div class="modal" id="confirm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Delete Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you, want to delete?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" id="delete-btn">Delete</button>
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection