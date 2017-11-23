@extends('layouts.app')

@section('content')
<div class="content-wrapper profile">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ route('home') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Usuarios</li>
      </ol>
      
      <!-- Table equipo -->
      <!-- Example DataTables Card-->
      <div class="card mb-3-equip">
        <div class="card-header">
          <i class="fa fa-fw fa-users" aria-hidden="true"></i>Usuarios</div>
        <div class="card-body">
            <table id="users-table" class="table table-bordered">
                <thead>
                <tr>
                    <!--<th>ID</th>-->
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Puesto</th>
                    <th>Correo</th>
                    <th>Fecha de creación</th>
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
<!-- Modal confirm -->
<div class="modal fade" id="elimmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¿Esta seguro que desea eliminar este usuario?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Tenga en cuenta que no podras recuperarlo
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <a class="btn btn-primary">Eliminar</a>
      </div>
    </div>
  </div>
</div>
@endsection