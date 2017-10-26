@extends('template.layout')
@section('title','Registrar')
 
@section('login')
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Register an Account</div>
      <div class="card-body">
        <!--<form>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">First name</label>
                <input class="form-control" id="exampleInputName" type="text" aria-describedby="nameHelp" placeholder="Enter first name">
              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName">Last name</label>
                <input class="form-control" id="exampleInputLastName" type="text" aria-describedby="nameHelp" placeholder="Enter last name">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputPassword1">Password</label>
                <input class="form-control" id="exampleInputPassword1" type="password" placeholder="Password">
              </div>
              <div class="col-md-6">
                <label for="exampleConfirmPassword">Confirm password</label>
                <input class="form-control" id="exampleConfirmPassword" type="password" placeholder="Confirm password">
              </div>
            </div>
          </div>
          <a class="btn btn-primary btn-block" href="login.html">Register</a>
        </form>-->
        {!! Form::open(['route' => 'users.store', 'method' => 'POST']) !!}
        <div class="form-group">
        <div class="form-row">
              <div class="col-md-6">
               {!! Form::label('name', 'Nombre') !!}
               {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre', 'required']) !!}
              </div>
              <div class="col-md-6">
                {!! Form::label('lastname', 'Apellidos') !!}
               {!! Form::text('lastname', null, ['class' => 'form-control', 'placeholder' => 'Apellidos', 'required']) !!}
              </div>
            </div>
          </div>
          <div class="form-group">
            {!! Form::label('email', 'Correo Electronico') !!}
               {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'example@gmail.com', 'required']) !!}
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                {!! Form::label('password', 'Contraseña') !!}
               {!! Form::password('password', ['class' => 'form-control', 'placeholder' => '************', 'required']) !!}
              </div>
              
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                {!! Form::label('type', 'Tipo') !!}
               {!! Form::select('type', ['' => 'Seleccione', 'Scrum Master' => 'Scrum Master', 'Project Owner' => 'Project Owner', 'Developer' => 'Developer'], null, ['class' => 'form-control']) !!}
              </div>
              
            </div>
          </div>
          <div class="form-group">
              {!! Form::submit('Registrar', ['class' => 'btn btn-primary']) !!}
          </div>
          {!! Form::close() !!}
        <div class="text-center">
          <a class="d-block small mt-3" href="/easytask/public/">Login Page</a>
          <a class="d-block small" href="users/create">Forgot Password?</a>
        </div>
      </div>
    </div>
  </div>
@endsection
