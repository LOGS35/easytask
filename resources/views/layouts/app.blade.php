<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EasyTask') }}</title>
    <!-- Bootstrap core CSS-->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <!-- Tags -->
    <link href="{{ asset('tags/select2.min.css') }}" rel="stylesheet">
    <!-- Sweet -->
    <script src="{{ asset('vendor/sweet/sweetalert.min.js') }}"></script>

    <!-- Styles -->
    <!--<link href="{} asset('css/app.css') {}" rel="stylesheet">-->
</head>
<body id="page-top">
     <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <!-- Branding Image -->
    <a class="navbar-brand" href="{{ url('/') }}">
       {{ config('app.name', 'EasyTask') }}
    </a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-target="#navbarResponsive" id="menumovil">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
     @if (Auth::check())
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="left" title="Dashboard">
          <a class="nav-link" href="{{ url('/') }}">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="left" title="Usuarios">
          <a class="nav-link" href="{{ route('users.index') }}">
              <i class="fa fa-fw fa-user" aria-hidden="true"></i>
              <span class="nav-link-text">Usuarios</span>
          </a>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="left" title="Clientes">
          <a class="nav-link" href="{{ route('clientes.index') }}">
              <i class="fa fa-fw fa-address-book" aria-hidden="true"></i>
              <span class="nav-link-text">Clientes</span>
          </a>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Equipo">
              <a class="nav-link nav-link-collapse collapsed dropdown" href="#collapseEquipo" data-target="#collapseEquipo">
                <i class="fa fa-fw fa-users"></i>
                <span class="nav-link-text">Equipo</span>
              </a>
              <ul class="sidenav-second-level collapse" id="collapseEquipo">
                @if(Auth::user()->id_equip != null)
                 <li>
                  <a href="{{ route('equipo.show', Auth::user()->id_equip) }}">Mi equipo</a>
                 </li>
                 @endif
                <li>
                  <a href="{{ route('equipo.index') }}">Todos los equipos</a>
                </li>
              </ul>
          </li> 
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Proyecto">
              <a class="nav-link nav-link-collapse collapsed dropdown" href="#collapseProject" data-target="#collapseProject">
                <i class="fa fa-fw fa-folder-open"></i>
                <span class="nav-link-text">Proyecto</span>
              </a>
              <ul class="sidenav-second-level collapse" id="collapseProject">
                <!--<li>
                  <a href="">Mi proyecto</a>
                </li>-->
                <li>
                  <a href="{{ route('proyecto.index') }}">Todos los proyectos</a>
                </li>
              </ul>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tareas">
              <a class="nav-link nav-link-collapse collapsed dropdown" href="#collapseTask" data-target="#collapseTask">
                <i class="fa fa-fw fa-list"></i>
                <span class="nav-link-text">Tareas</span>
              </a>
              <ul class="sidenav-second-level collapse" id="collapseTask">
                <li>
                  <a href="">Mis tareas</a>
                </li>
                <li>
                  <a href="">Todas las tareas</a>
                </li>
              </ul>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Noticias">
              <a class="nav-link nav-link-collapse collapsed dropdown" href="#collapsenews" data-target="#collapsenews">
                <i class="fa fa-fw fa-newspaper-o"></i>
                <span class="nav-link-text">Noticias</span>
              </a>
              <ul class="sidenav-second-level collapse" id="collapsenews">
                <li>
                  <a href="">Mis noticias</a>
                </li>
                <li>
                  <a href="">Todas las noticias</a>
                </li>
              </ul>
          </li>
        <!--<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
          <a class="nav-link" href="tables.html">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Tables</span>
          </a>
        </li>-->
        <!--<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Components</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li>
              <a href="navbar.html">Navbar</a>
            </li>
            <li>
              <a href="cards.html">Cards</a>
            </li>
          </ul>
        </li>-->
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      @endif
      <ul class="navbar-nav ml-auto">
        @if (Auth::guest())
            <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
            <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Registrar</a></li>
        @else
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-envelope"></i>
            <span class="d-lg-none">Mensajes
              <span class="badge badge-pill badge-primary">12 nuevos</span>
            </span>
            <span class="indicator text-primary d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">Nuevos Mensajes:</h6>
            <!--<div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>David Miller</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>Jane Smith</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00 instead of 4:00. Thanks!</div>
            </a>-->
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">Ver todos los mensajes</a>
          </div>
        </li>
        <!--<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-bell"></i>
            <span class="d-lg-none">Alerts
              <span class="badge badge-pill badge-warning">6 New</span>
            </span>
            <span class="indicator text-warning d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">New Alerts:</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-danger">
                <strong>
                  <i class="fa fa-long-arrow-down fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">View all alerts</a>
          </div>
        </li>-->
        <li class="nav-item dropdown">
        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-expanded="false">
                <!--<i class="fa fa-fw fa-sign-out"></i>-->{{ Auth::user()->name }} <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li><h6 class="dropdown-header">Menu</h6></li>
                <div class="dropdown-divider"></div>
                <li><a class="dropdown-item small" href="{{ route('users.show', Auth::user()->id) }}">
                <i class="fa fa-user" aria-hidden="true"></i>Mi perfil</a></li>
                <div class="dropdown-divider"></div>
                <li><a class="dropdown-item small" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-fw fa-sign-out"></i>Desconectar</a></li>
            </ul>
        </li>
        <li class="nav-item">
          <form class="form-inline my-2 my-lg-0 mr-lg-2">
            <div class="input-group">
              <input class="form-control" type="text" placeholder="Buscar por...">
              <span class="input-group-btn">
                <button class="btn btn-primary" type="button">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
          </form>
        </li>
        @endif
      </ul>
    </div>
  </nav>
  @yield('content')
  @if (Auth::check())
  <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Easy Task 2017</small>
        </div>
      </div>
    </footer>
<!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ Auth::user()->name }} ¿Estas seguro que quieres salir?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Selecciona "Desconectar" para cerrar sesión.</div>
              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-primary">
                <i class="fa fa-fw fa-sign-out"></i>Desconectar</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
                </form>
              </div>
          </div>
      </div>
  </div>
   @endif
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/script-action.js') }}"></script>
    <!-- kanban -->
    <script src="{{ asset('js/kanban.js') }}"></script>
    <script src="{{ asset('js/script-kanban.js') }}"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/popper/popper.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <!-- Page level plugin JavaScript-->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin.min.js') }}"></script>
    <!-- Custom scripts for this page-->
    <script src="{{ asset('js/sb-admin-datatables.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-charts.min.js') }}"></script>
    <!-- tags -->
    <script src="{{ asset('tags/select2.min.js') }}"></script>
    <!-- Sweet -->
    @include('sweet::alert')
    
    @if (session('status'))
    <div class="alert alert-success animated fadeInUp">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ session('status') }}
    </div>
    @endif
</body>
</html>