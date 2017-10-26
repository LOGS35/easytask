@extends('layouts.app')

@section('content')
<div class="login">
<div class="container">
    <div class="card card-register mx-auto mt-5">
            <div class="panel panel-default">
                <div class="card-header">Recuperar contraseña</div>

                <div class="card-body">

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">Correo electrónico</label>

                            <div class="input">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    Enviar contraseña
                                </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@if ($errors->has('email'))
<div class="alert alert-warning animated fadeInUp">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
</div>
@endif
@endsection
