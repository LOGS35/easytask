@extends('layouts.app')

@section('content')
<div class="content-wrapper profile">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ route('home') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Noticias</li>
      </ol>
      <!-- Acciones -->
      <div class="card mb-3">
              <div class="card-header">
                  <i class="fa fa-cog fa-fw" aria-hidden="true"></i>Acciones
              </div>
              <div class="card-body">
                    <a href="" class="btn btn-success" data-toggle="modal" data-target="#crearteam">Crear noticia <i class="fa fa-plus fa-fw" aria-hidden="true"></i></a>
              </div> 
          </div>
      <!-- noticias -->
      <div class="mb-0 mt-4">
            <i class="fa fa-newspaper-o"></i> Últimas noticias</div>
          <hr class="mt-2">
          <div class="card-columns mb-3-equip">
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
    <!-- /.container-fluid-->
</div>
    <!-- Modal -->
        <!-- Crear noticia -->
<div class="modal fade bd-example-modal-lg" id="crearteam" role="dialog" aria-labelledby="crearteam" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="crearteam">Crear noticia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['route' => 'noticia.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
               {!! Form::label('title', 'Título') !!}
               {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Título', 'required']) !!}
              </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
               {!! Form::label('content', 'Contenido') !!}
               {!! Form::textarea('content', null, ['size' => '5x5','class' => 'form-control ckeditor', 'placeholder' => 'Contenido', 'required']) !!}
              </div>
            </div>
        </div>
        <div class="form-group">
                {!! Form::label('equipo', 'Imagen de la noticia: ') !!}
                {!! Form::file('file') !!}
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Crear noticia</button>
      </div>
              {!! Form::close() !!}
    </div>
  </div>
</div>
@if ($errors->any())
<div class="alert alert-warning animated fadeInUp">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
     @foreach ($errors->all() as $error)
        <span class="help-block">
            <strong>{{ $error }}</strong>
        </span>
    @endforeach
</div>
@endif
@endsection