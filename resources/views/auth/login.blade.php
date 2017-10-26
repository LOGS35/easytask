@extends('layouts.app')

@section('content')
<div class="login">
<div class="container">
    <div class="card card-login mx-auto mt-5">
                <div class="card-header">Login</div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="exampleInputEmail1">Dirección de correo</label>

                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="exampleInputPassword1">Contraseña</label>

                                <input id="password" type="password" class="form-control" name="password" required>

                        </div>

                        <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recuerdame
                                    </label>
                                </div>
                        </div>
                        <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    Ingresar
                                </button>

                                <a class="btn btn-danger" href="{{ route('password.request') }}">
                                    ¿No recuerdas tu contraseña?
                                </a>
                        </div>
                    </form>
                </div>
    </div>
</div>
</div>
@if ($errors->has('email') || $errors->has('password'))
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
</div>
@endif
@endsection
