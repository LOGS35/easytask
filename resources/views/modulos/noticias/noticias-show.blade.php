@extends('layouts.app')

@section('content')
@foreach ($noticia as $noticia)
<div class="content-wrapper mb-3-equip">
    <div class="container-fluid">
       <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ route('home') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
          <a href="{{ route('noticia.index') }}">Noticias</a>
        </li>
        <li class="breadcrumb-item active">{{ $noticia->title }}</li>
      </ol>
      @if(Auth::user()->id == $noticia->user_id)
          <div class="card mb-3">
              <div class="card-header">
                  <i class="fa fa-cog fa-fw" aria-hidden="true"></i>Acciones para la noticia: {{ $noticia->title }}
              </div>
              <div class="card-body">
                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#editnoticia">Editar noticia<i class="fa fa-pencil fa-fw" aria-hidden="true"></i></a>
                    <a href="#" data-toggle="modal" data-target="#elimnoticia" class="btn btn-danger">Eliminar noticia <i class="fa fa-trash fa-fw" aria-hidden="true"></i></a>
              </div> 
          </div>
      @endif
       <div class="row">
            <div class="col-md-12">
                <img class="card-img-top img-fluid w-100" src="{{ route('storage',$noticia->image) }}" alt="">
                <div class="card-body">
                <h1 class="card-title mb-1">{{ $noticia->title }}</h1>
                <p class="card-text">
                    Enviado por: <a href="{{ route('users.show',$noticia->user_id) }}">{{ $noticia->name.' '.$noticia->lastname }}</a>
                </p>
                <hr>
                <div class="content">
                    {!! $noticia->content !!}
                </div>
              </div>
              <div class="card-footer small text-muted">Fecha: {{ Carbon\Carbon::parse($noticia->fecha)->format('d-m-Y \a \l\a\s H:i:s') }}</div>
            </div>
        </div>
        <!-- Commentarios -->
      <div class="card mt-3">
          <div class="card-header">
              <i class="fa fa-comments fa-fw" aria-hidden="true"></i>Comentarios de la noticia
          </div>
          <div class="card-body" id="content-message">
              <div class="old" id="old_comments">
              <div id="coment-ajax">
              @foreach ($comentarios as $comments)
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
                     <input type="text" class="form-control" id="message-noticia">
                 </div>
                 <div class="col-md-2">
                     <button class="btn btn-success form-control" id="submit-comment-noticia" data-id_user="{{ Auth::user()->id }}" data-id_noticia="{{ $noticia->noticia_id }}">Enviar</button>  
                 </div>
             </div>
              </div>
          </div>
      </div>
      <!-- endcomentarios -->
    </div>
</div>
    <!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="editnoticia" tabindex="-1" role="dialog" aria-labelledby="crearteam" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="crearteam">Modificar noticia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['route' => ['noticia.update', $noticia->noticia_id], 'method' => 'PUT', 'files' => true]) !!}
        <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
               {!! Form::label('title', 'Nombre') !!}
               {!! Form::text('title', $noticia->title, ['class' => 'form-control', 'placeholder' => 'Titulo', 'required']) !!}
              </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
               {!! Form::label('content', 'Contenido') !!}
               {!! Form::textarea('content', $noticia->content, ['size' => '5x5','class' => 'form-control ckeditor', 'placeholder' => 'Contenido', 'required']) !!}
              </div>
            </div>
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
<div class="modal fade" id="elimnoticia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¿Esta seguro que desea eliminar la noticia?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        La noticia "{{ $noticia->title }}" sera eliminada para siempre de la base de datos
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <a href="{{ route('noticia.destroy', $noticia->noticia_id) }}" class="btn btn-primary">Eliminar</a>
      </div>
    </div>
  </div>
</div>
@endforeach
@endsection
