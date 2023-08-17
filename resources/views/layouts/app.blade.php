<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>WEBSAF</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('template/AdminLTE-3.0.5/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet"
        href="{{ asset('template/AdminLTE-3.0.5/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    <!-- DataTables -->
    <link rel="stylesheet"
        href="{{ asset('template/AdminLTE-3.0.5/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('template/AdminLTE-3.0.5/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('select2/dist/css/select2.min.css') }}">

    <!-- SweetAlert2 -->
    <link rel="stylesheet"
        href="{{ asset('template/AdminLTE-3.0.5/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('template/AdminLTE-3.0.5/plugins/toastr/toastr.min.css') }}">

    {{-- STEPS --}}
    <link rel="stylesheet" href="{{ asset('jquery-steps/demo/css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('jquery-steps/demo/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('jquery-steps/demo/css/jquery.steps.css') }}">

    {{-- Highcharts --}}
    <link rel="stylesheet"src="{{asset('Highcharts/code/css/highcharts.css')}}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template/AdminLTE-3.0.5/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/miEstilo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/MiEstiloSteps.css') }}">
    @yield('css')
    <!-- Google Font: Source Sans Pro -->
    <link href="{{ asset('google-fonts/sans_pro.css') }}" rel="stylesheet">
</head>

<body class="sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed control-sidebar-slide-open text-sm @yield('sidebar-collapse')">
    @php
    $nombre_usuario = Auth::user()->name;
    if(Auth::user()->administrativo)
    {
        $nombre_usuario = Auth::user()->administrativo->nombre.' '.Auth::user()->administrativo->paterno.' '.Auth::user()->administrativo->materno;
    }else if(Auth::user()->profesor){
        $nombre_usuario = Auth::user()->profesor->nombre.' '.Auth::user()->profesor->paterno.' '.Auth::user()->profesor->materno;
    }else if(Auth::user()->estudiante){
        $nombre_usuario = Auth::user()->estudiante->nombre.' '.Auth::user()->estudiante->paterno.' '.Auth::user()->estudiante->materno;
    }
    @endphp

    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark navbar-warning bg-blue">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                {{-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Home</a>
                </li> --}}
            </ul>


            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                {{-- <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="dist/img/user1-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="dist/img/user8-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="dist/img/user3-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i
                                                class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li> --}}
                <!-- Notifications Dropdown Menu -->
                {{-- <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge" id="nroNotificaciones">0</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="contenedorNotificaciones">

                    </div>
                </li> --}}
                <li class="nav-item dropdown user user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('imgs/users/' . Auth::user()->foto) }}"
                            class="user-image img-circle elevation-2" alt="User Image">
                        <span class="hidden-xs">{{ $nombre_usuario }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header bg-blue">
                            <img src="{{ asset('imgs/users/' . Auth::user()->foto) }}" class="img-circle elevation-2" alt="User Image">
                            <p class="text-white">{{ $nombre_usuario }}{{-- <small>Member since Nov. 2012</small>--}}</p>
                            <p class="text-white">{{Auth::user()->tipo}}</p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="row">
                                <div class="col-4 text-center">
                                    <a href="{{ route('users.config', Auth::user()->id) }}"
                                        class="btn btn-default">Perfil</a>
                                </div>
                                <div class="col-4 text-center">
                                </div>
                                <div class="col-4 text-center">
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" class="btn btn-default">Salir</a>
                                </div>
                            </div>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <!-- /.row -->
                        </li>
                        <!-- Menu Footer-->
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar elevation-4 sidebar-dark-navy bg-blue">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="brand-link navbar-warning bg-blue">
                <img src="{{ asset('imgs/' . App\RazonSocial::first()->logo) }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">{{ App\RazonSocial::first()->alias }}</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('imgs/users/' . Auth::user()->foto) }}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="{{ route('users.config', Auth::user()->id) }}"
                            class="d-block">{{ $nombre_usuario }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Inicio</p>
                            </a>
                        </li>
                        @if(Auth::user()->tipo == 'ADMINISTRADOR')
                        @include('includes.menu.menu_admin')
                        @endif
                        @if(Auth::user()->tipo == 'PROFESOR')
                        @include('includes.menu.menu_profesor')
                        @endif
                        @if(Auth::user()->tipo == 'ESTUDIANTE')
                        @include('includes.menu.menu_estudiante')
                        @endif
                        @if(Auth::user()->tipo == 'SECRETARIA ACADÉMICA')
                        @include('includes.menu.menu_secretaria')
                        @endif
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" @yield('background-image')>
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        <input type="hidden" name="token" id="token" value="{{ csrf_token() }}">
        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; {{ date('Y') }} WEBSAF</strong>
            Todos los derechos reservados.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('template/AdminLTE-3.0.5/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('template/AdminLTE-3.0.5/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('template/AdminLTE-3.0.5/plugins/overlayScrollbars/js/jquery.') }}overlayScrollbars.min.js">
    </script>

    <!-- Select2 -->
    <script src="{{ asset('select2/dist/js/select2.full.min.js') }}"></script>

    <!-- DataTables -->
    <script src="{{ asset('template/AdminLTE-3.0.5/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/AdminLTE-3.0.5/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}">
    </script>
    <script src="{{ asset('template/AdminLTE-3.0.5/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}">
    </script>
    <script src="{{ asset('template/AdminLTE-3.0.5/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}">
    </script>
    
    <!-- SweetAlert2 -->
    <script src="{{ asset('template/AdminLTE-3.0.5/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('template/AdminLTE-3.0.5/plugins/toastr/toastr.min.js') }}"></script>

    <!-- JQUERY VALIDATE -->
    <script src="{{ asset('template/AdminLTE-3.0.5/plugins/jquery-validation/jquery.validate.min.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('template/AdminLTE-3.0.5/dist/js/adminlte.js') }}"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="{{ asset('template/AdminLTE-3.0.5/dist/js/demo.js') }}"></script>

    <!-- PAGE SCRIPTS -->
    <script src="{{ asset('template/AdminLTE-3.0.5/dist/js/pages/dashboard2.js') }}"></script>

    {{-- DEBOUNCE --}}
    <script src="{{ asset('js/debounce.js') }}"></script>

    <!-- Highcharts -->
    <script src="{{asset('Highcharts/code/highcharts.js')}}"></script>
    <script src="{{asset('Highcharts/code/highcharts-3d.src.js')}}"></script>
    <script src="{{asset('Highcharts/code/modules/exporting.js')}}"></script>
    <script src="{{asset('Highcharts/code/modules/export-data.js')}}"></script>

    {{-- STEPS --}}
    {{-- <script src="{{ asset('jquery-steps/src/defaults.js') }}"></script>
    --}}
    <script src="{{ asset('jquery-steps/lib/modernizr-2.6.2.min.js') }}"></script>
    <script src="{{ asset('jquery-steps/lib/jquery.cookie-1.3.1.js') }}"></script>
    <script src="{{ asset('jquery-steps/build/jquery.steps.js') }}"></script>
    <script src="{{ asset('jquery-steps/build/jquery.steps.fix.js') }}"></script>

    {{-- MIS SCRIPTS --}}

    <script>
        $('[data-toggle="tooltip"]').tooltip();

        lenguaje = {
            "decimal": "",
            "emptyTable": "No se encontraron registros",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Registros",
            "infoEmpty": "Mostrando 0 to 0 of 0 Registros",
            "infoFiltered": "(Filtrado de _MAX_ total registros)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Registros",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": '<i class="fa fa-fast-backward"></i>',
                "last": '<i class="fa fa-fast-forward"></i>',
                "next": '<i class="fa fa-step-forward"></i>',
                "previous": '<i class="fa fa-step-backward"></i>'
            }
        };

        lenguajeSelect2 = {
            noResults: function() {
                return "No hay resultados";
            },
            searching: function() {
                return "Buscando...";
            }
        }

        $.extend($.validator.messages, {
            required: "Este campo es obligatorio.",
            maxlength: $.validator.format("El tamaño maximo es de {0} caracteres."),
            minlength: $.validator.format("El tamaño minimo es de {0} caracteres."),
            rangelength: $.validator.format("El valor debe estar entre {0} y {1}."),
            email: "Correo electronico no valido.",
            url: "URL no valida.",
            date: "Formato de fecha no valido.",
            number: "El valor debe ser númerico.",
            max: $.validator.format("El valor debe ser menor o igual que {0}"),
            min: $.validator.format("El valor debe ser mayor o igual que {0}"),
        });

        $('.select2').select2();

        function mensajeNotificacion(mensaje, tipo) {
            let Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            Toast.fire({
                icon: tipo,
                title: mensaje
            })
        }

    </script>
    @yield('scripts')

</body>

</html>
