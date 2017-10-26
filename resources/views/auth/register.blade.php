@extends('layouts.app')

@section('content')
<div class="login register">
<div class="container">
    <div class="card card-register mx-auto mt-5">
                <div class="card-header">Registro</div>

                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
<div class="form-row">
              <div class="col-md-6">
                        <div class="{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="control-label">Nombres</label>

                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                
                        </div>
    </div>
                       <div class="col-md-6">
                           <div class="{{ $errors->has('lastname') ? ' has-error' : '' }}">
                            <label for="lastname" class="control-label">Apellidos</label>

                                <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required autofocus>

                                
                           </div>
                       </div>
                        </div>
                        </div>
<div class="form-group">
<div class="form-row">
                        <div class="col-md-12{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email">Correo electrónico</label>

                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                
                        </div>
    </div>
                        </div>
                        <div class="form-group">
<div class="form-row">
                        <div class="col-md-6{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password">Contraseña</label>

                                <input id="password" type="password" class="form-control" name="password" required>

                                
                        </div>

                        <div class="col-md-6">
                            <label for="password-confirm">Repetir contraseña</label>

                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    {!! Form::label('type', 'Rol') !!}
               {!! Form::select('type', ['' => 'Seleccione', 'Scrum Master' => 'Scrum Master', 'Project Owner' => 'Project Owner', 'Developer' => 'Developer'], null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    Registrar
                                </button>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</div>
@if ($errors->has('password') || $errors->has('email') || $errors->has('lastname') || $errors->has('name'))
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
</div>
@endif
@endsection
