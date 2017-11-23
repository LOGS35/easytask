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
          <a href="{{ route('proyecto.index') }}">Proyectos</a>
        </li>
        <li class="breadcrumb-item active">{{ $proyecto->name }}</li>
      </ol>
      <!-- Info -->
      <div class="card mb-3">
          <div class="card-header">
              <i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>Información del proyecto
          </div>
          <div class="card-body">
                <div class="estado">
                    <p class="badge badge-danger">Nombre: {{ $proyecto->name }}</p>
                </div>
                <div class="estado">
                    <p class="badge badge-success">Estado: {{ $proyecto->estado }}</p>
                </div>
                <div class="estado">
                    <p class="badge badge-info">Fecha de creación: {{ Carbon\Carbon::parse($proyecto->created_at)->format('d-m-Y') }}</p>
                </div>
                @if ($proyecto->fecha_fin != null)
                    <div class="estado">
                        <p class="badge badge-info">Fecha de finalización: {{ Carbon\Carbon::parse($proyecto->fecha_fin)->format('d-m-Y') }}</p>
                    </div>
                @endif
          </div>
      </div>
      <div class="descripcion mb-3">
            <div class="card">
               <div class="card-header">
                   <i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>Descripción del proyecto
               </div>
               <div class="card-body">
                   {{ $proyecto->description }}
               </div>
            </div>
        </div>
      <!-- Acciones -->
      @if (Auth::user()->type == "Scrum Master")
          <div class="card mb-3">
              <div class="card-header">
                  <i class="fa fa-cog fa-fw" aria-hidden="true"></i>Acciones para el proyecto: {{ $proyecto->name }}
              </div>
              <div class="card-body">
                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#editeam">Editar proyecto<i class="fa fa-pencil fa-fw" aria-hidden="true"></i></a>
                    <a href="#" data-toggle="modal" data-target="#eliteam" class="btn btn-danger">Eliminar proyecto <i class="fa fa-trash fa-fw" aria-hidden="true"></i></a>
                    <a href="#" data-toggle="modal" data-target="#taskadd" class="btn btn-info">Crear tarea<i class="fa fa-fw fa-list"></i></a>
              </div> 
          </div>
      @endif
      <!-- Table equipo -->
      
      <div class="card mb-3">
          <div class="card-header">
              <i class="fa fa-fw fa-list"></i>Tareas
          </div>
          <div class="card-body">
              <div class="drag-container">
	<ul class="drag-list">
		<li class="drag-column drag-column-on-hold">
			<span class="drag-column-header">
				<h2>Pendiente</h2>
			</span>
				
			<div class="drag-options" id="options1"></div>
			
			<ul class="drag-inner-list" id="pendiente">
			@foreach ($task as $task)
				<li class="drag-item" task="{{ $task->id }}" data-name_task="{{ $task->nombre }}" data-description="{{ $task->description }}">
				    <div class="name">{{ $task->nombre }}</div>
                    <div class="weight">{{ $task->peso }}</div>
				</li>
            @endforeach
			</ul>
		</li>
		<!--{!! $s = 1 !!}-->
		@foreach ($users as $users)
		<li class="drag-column drag-column-in-progress">
			<span class="drag-column-header">
				<h2>{{ $users->name.' '.$users->lastname }}</h2>
			</span>
			<div class="drag-options" id="options2"></div>
			<ul class="drag-inner-list users-columns" id="{{ $s++ }}">
		    @foreach ($taskuser as $task)
                @if ($users->id == $task->id_usuario)
                    <li class="drag-item" data-id_task="{{ $task->id }}" data-name_task="{{ $task->nombre }}" data-description="{{ $task->description }}" data-id_user="{{ $users->id }}">
                        <div class="name">{{ $task->nombre }}</div>
                        <div class="weight">{{ $task->peso }}</div>
                    </li>
                @endif
		    @endforeach
			</ul>
		</li>
		@endforeach
		<li class="drag-column drag-column-needs-review">
			<span class="drag-column-header">
				<h2>Necesita revisión</h2>
			</span>
			<div class="drag-options" id="options3"></div>
			<ul class="drag-inner-list" id="revision">
			    @foreach ($taskrevision as $task)
				<li class="drag-item" task="{{ $task->id }}" data-name_task="{{ $task->nombre }}" data-description="{{ $task->description }}">
				    <div class="name">{{ $task->nombre }}</div>
                    <div class="weight">{{ $task->peso }}</div>
				</li>
            @endforeach
			</ul>
		</li>
		<li class="drag-column drag-column-approved">
			<span class="drag-column-header">
				<h2>Aprobado</h2>
			</span>
			<div class="drag-options" id="options4"></div>
			<ul class="drag-inner-list" id="aprobado">
			    @foreach ($taskcomplete as $task)
				<li class="drag-item" task="{{ $task->id }}" data-name_task="{{ $task->nombre }}" data-description="{{ $task->description }}">
				    <div class="name">{{ $task->nombre }}</div>
                    <div class="weight">{{ $task->peso }}</div>
				</li>
            @endforeach
			</ul>
		</li>
	</ul>
</div>
          </div>
      </div>
      <!-- Example DataTables Card-->
      <!-- Commentarios -->
      <div class="card mb-3-equip">
          <div class="card-header">
              <i class="fa fa-comments fa-fw" aria-hidden="true"></i>Comentarios del proyecto
          </div>
          <div class="card-body" id="content-message">
              <div class="old" id="old_comments">
              <div id="coment-ajax">
              @foreach ($comentarios_proyecto as $comments)
                     @if (Auth::user()->id == $comments->id)
                     <div class="coment">
                      <div class="texto">{{ $comments->descripcion }}</div>
                      <div class="user"> : <span class="badge badge-success">{{ $comments->name }}</span></div>
                      <div class="date">{{ $comments->created_at }}</div>
                      </div>
                      @else
                      <div class="coment2">
                      <div class="user"><span class="badge badge-warning">{{ $comments->name }}</span> : </div>
                          <div class="texto">{{ $comments->descripcion }}</div>
                          <div class="date">{{ $comments->created_at }}</div>
                      </div>
                      @endif
              @endforeach
                  </div>
              </div>
              <div class="new" id="resultado_comments">
                  
              </div>
          </div>
          <div class="card-footer">
             <div class="form-group">
             <div class="form-row">
                 <div class="col-md-10">
                     <input type="text" class="form-control" id="message">
                 </div>
                 <div class="col-md-2">
                     <button class="btn btn-success form-control" id="submit-comment" data-id_user="{{ Auth::user()->id }}" data-id_proy="{{ $proyecto->id }}">Enviar</button>  
                 </div>
             </div>
              </div>
          </div>
      </div>
      <!-- endcomentarios -->
      
    </div>
    <!-- /.container-fluid-->
</div>
    <!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="editeam" role="dialog" aria-labelledby="crearteam" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="crearteam">Editar proyecto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['route' => ['proyecto.update', $proyecto->id], 'method' => 'PUT']) !!}
        <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
               {!! Form::label('name', 'Nombre') !!}
               {!! Form::text('name', $proyecto->name, ['class' => 'form-control', 'placeholder' => 'Nombre', 'required']) !!}
              </div>
              <div class="col-md-6">
               {!! Form::label('estado', 'Estado') !!}
               @if ($proyecto->estado == 'En proceso')
                   {!! Form::select('estado', ['En proceso' => 'En proceso', 'En revisión' => 'En revisión', 'Incompleto' => 'Incompleto', 'Detenido' => 'Detenido', 'Terminado' => 'Terminado'], null, ['class' => 'form-control', 'required']) !!}
               @elseif ($proyecto->estado == 'En revisión')
                   {!! Form::select('estado', ['En revisión' => 'En revisión', 'En proceso' => 'En proceso', 'Incompleto' => 'Incompleto', 'Detenido' => 'Detenido', 'Terminado' => 'Terminado'], null, ['class' => 'form-control', 'required']) !!}
               @elseif ($proyecto->estado == 'Incompleto')
                   {!! Form::select('estado', ['Incompleto' => 'Incompleto', 'En proceso' => 'En proceso', 'En revisión' => 'En revisión', 'Detenido' => 'Detenido', 'Terminado' => 'Terminado'], null, ['class' => 'form-control', 'required']) !!}
               @elseif ($proyecto->estado == 'Detenido')
                   {!! Form::select('estado', ['Detenido' => 'Detenido', 'En proceso' => 'En proceso', 'En revisión' => 'En revisión', 'Incompleto' => 'Incompleto', 'Terminado' => 'Terminado'], null, ['class' => 'form-control', 'required']) !!}
               @elseif ($proyecto->estado == 'Terminado')
                   {!! Form::select('estado', ['Terminado' => 'Terminado', 'En proceso' => 'En proceso', 'En revisión' => 'En revisión', 'Incompleto' => 'Incompleto', 'Detenido' => 'Detenido'], null, ['class' => 'form-control', 'required']) !!}
                @endif
              </div>
              <!--<div class="col-md-6">
               {!! Form::label('estado', 'Estado') !!}
               {!! Form::select('estado', ['' => 'Seleccione', 'Activo' => 'Activo', 'Inactivo' => 'Inactivo'], null, ['class' => 'form-control']) !!}
              </div>-->
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('description', 'Descripción') !!}
            {!! Form::textarea('description', $proyecto->description, ['size' => '5x5','class' => 'form-control', 'placeholder' => 'Descripción', 'required']) !!}
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
        <h5 class="modal-title" id="exampleModalLabel">¿Esta seguro que desea eliminar el proyecto?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        El proyecto {{ $proyecto->nombre }} y todo lo relacionado con este se eliminará
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <a href="{{ route('proyecto.destroy', $proyecto->id) }}" class="btn btn-primary">Eliminar</a>
      </div>
    </div>
  </div>
</div>
<!-- Modal confirm -->
<div class="modal fade" id="elimmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¿Esta seguro que desea eliminar la tarea?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        La tarea se eliminará de forma permanente
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <a class="btn btn-primary">Eliminar</a>
      </div>
    </div>
  </div>
</div>
<!-- Modal add task -->
<div class="modal fade bd-example-modal-lg" id="taskadd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear tareas para el proyecto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['route' => 'task.store', 'method' => 'POST']) !!}
        <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
               {!! Form::label('nombre', 'Título') !!}
               {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre', 'required']) !!}
              </div>
              <div class="col-md-6">
               {!! Form::label('peso', 'Peso') !!}
               {!! Form::select('peso', ['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione', 'required']) !!}
              </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
               {!! Form::label('description', 'Descripción') !!}
               {!! Form::textarea('description', null, ['size' => '5x5','class' => 'form-control', 'placeholder' => 'Descripción', 'required']) !!}
               <div class="hidden">{!! Form::text('id_proyecto', $proyecto->id, ['class' => 'form-control', 'placeholder' => 'Id proyecto', 'required']) !!}</div>
              </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Crear tarea</button>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection
