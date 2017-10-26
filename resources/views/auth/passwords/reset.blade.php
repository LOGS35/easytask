@extends('layouts.app')

@section('content')
<div class="login">
<div class="container">
    <div class="card card-register mx-auto mt-5">
            <div class="panel panel-default">
                <div class="card-header">Restablecer contraseña</div>

                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">Correo electrónico</label>

                                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">Contraseña</label>
                                <input id="password" type="password" class="form-control" name="password" required>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="control-label">Confirmar contraseña</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>

                        <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    Restablecer contraseña
                                </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@if ($errors->has('email') || $errors->has('password') || $errors->has('password_confirmation'))
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
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
</div>
@endif
@endsection
