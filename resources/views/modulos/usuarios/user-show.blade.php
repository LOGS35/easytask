@extends('layouts.app')

@section('content')
<div class="content-wrapper profile">
    <div class="container-fluid">
       <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ route('home') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
          <a href="{{ route('users.index') }}">Usuarios</a>
        </li>
        <li class="breadcrumb-item active">{{ $users->name }} {{ $users->lastname }}</li>
      </ol>
       <div class="row">
        <div class="col-xs-12 col-md-7">
           <div class="card">
            <div class="card-header">Perfil
                @if(Auth::user()->id == $users->id)
                <i class="fa fa-pencil btn btn-primary" aria-hidden="true"></i>
                @endif
            </div>
            <div class="card-body">
               {!! Form::open(['route' => ['users.update', Auth::user()->id], 'method' => 'PUT']) !!}
                   <div class="form-group">
                       <div class="form-row">
                           <div class="col-md-6">
                               <div class="{{ $errors->has('name') ? ' has-error' : '' }}">
                                {!! Form::label('name', 'Nombre') !!}
                                {!! Form::text('name', Auth::user()->name, ['class' => 'form-control', 'placeholder' => 'Nombre', 'required', 'autofocus']) !!}
                                
                               </div>
                           </div>
                           <div class="col-md-6">
                               <div class="{{ $errors->has('lastname') ? ' has-error' : '' }}">
                                {!! Form::label('lastname', 'Apellidos') !!}
                                {!! Form::text('lastname', Auth::user()->lastname, ['class' => 'form-control', 'placeholder' => 'Apellidos', 'required', 'autofocus']) !!}
                                
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="form-group">
                       <div class="form-row">
                           <div class="col-md-12">
                              <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                               {!! Form::label('email', 'Correo Electronico') !!}
                               {!! Form::email('email', Auth::user()->email, ['class' => 'form-control', 'placeholder' => 'example@gmail.com', 'required', 'autofocus']) !!}
                                
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="form-group">
                       <div class="form-row">
                           <div class="col-md-12">
                               <div class="{{ $errors->has('type') ? ' has-error' : '' }}">
                                <label for="email" class="control-label">Rol</label>
                                <select name="type" id="type" class="form-control" required autofocus>
                                   @if (Auth::user()->type == "Scrum Master")
                                    <option value="{{ Auth::user()->type }}">{{ Auth::user()->type }}</option>
                                    <option value="Developer">Developer</option>
                                   @endif
                                   @if (Auth::user()->type == "Developer")
                                    <option value="{{ Auth::user()->type }}">{{ Auth::user()->type }}</option>
                                    <option value="Scrum Master">Scrum Master</option>
                                   @endif
                                </select>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="form-group button-submit">
                       <div class="form-row">
                           <div class="col-md-12">
                              {!! Form::submit('Modificar', ['class' => 'btn btn-info']) !!}
                           </div>
                       </div>
                   </div>
                {!! Form::close() !!}
            </div>
            <div class="card-footer" style="text-align:right;">
                <span>Miembro desde: {{ Carbon\Carbon::parse($users->created_at)->format('d-m-Y') }}</span>
            </div>
        </div>
    </div>
        <div class="col-xs-12 col-md-5">
            <div class="card">
                <div class="card-header">Equipo</div>
                <div class="card-body">
                    @if($users->id_equip != null)
                        <p><span class="badge badge-danger">Nombre:</span> <a href="{{ route('equipo.show', $equipo->id) }}">{{ $equipo->nombre }}</a></p>
                        <p><span class="badge badge-info">Fecha de creación:</span> {{ Carbon\Carbon::parse($equipo->created_at)->format('d-m-Y') }}</p>
                        <p><span class="badge badge-primary">Proyecto actual:</span> 
                        @if($equipo->id_proy != null)
                            {{ $proyecto->name }}
                        @else
                            no tiene asignado un proyecto
                        @endif
                        </p>
                        @if(Auth::user()->id == $users->id)
                            <a data-href="" class="btn btn-danger" style="float:right;color:#fff;cursor:pointer;">Salir del equipo <i class="fa fa-sign-out" aria-hidden="true"></i></a>
                        @endif
                    @else
                        <p>Esta persona no es parte de un equipo</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@if ($errors->has('password') || $errors->has('email') || $errors->has('lastname') || $errors->has('name') || $errors->has('type'))
<div class="alert alert-warning animated fadeInUp">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
</div>
@endif
@endsection
