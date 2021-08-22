<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SIAD - Poder Judicial</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top" style="background-color: #edeceb;">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/home') }}">
                    SIAD
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                @can('acceso.usuario.index')
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-laptop"></i> <span>Informática</span>
                        </a>
                        <ul class="dropdown-menu">
                            @can('poder_judicial.sedes.index')
                            <li><a href="{{route('poder_judicial.sedes.index')}}">Sedes</a></li>
                            @endcan
                            @can('poder_judicial.oojj.index')
                            <li><a href="{{route('poder_judicial.oojj.index')}}">Dependencias</a></li>
                            @endcan
                            @can('producto.categoria.index')
                            <li><a href="{{route('producto.categoria.index')}}">Categoria</a></li>
                            @endcan
                            @can('producto.producto.index')
                            <li><a href="{{route('producto.producto.index')}}">Producto</a></li>
                            @endcan
                            @can('acceso.usuario.index')
                            <li><a href="{{route('acceso.usuario.index')}}">Usuarios</a></li>
                            @endcan
                            @can('acceso.roles.index')
                            <li><a href="{{route('acceso.roles.index')}}">Roles</a></li>
                            @endcan
                            @can('acceso.permisos.index')
                            <li><a href="{{route('acceso.permisos.index')}}">Permisos</a></li>
                            @endcan                        
                        </ul>
                    </li>
                </ul>
                @endcan
                @can('pedidos.pedidos.index')
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-university"></i> <span>Administración de Sedes</span>
                        </a>
                        <ul class="dropdown-menu">
                            @can('pedidos.shop.index')
                            <li><a href="{{route('pedidos.shop.index')}}"> Realizar de Pedido</a></li>
                            @endcan  
                            @can('pedidos.pedidos.index')
                            <li><a href="{{route('pedidos.pedidos.index')}}"> Solicitudes de Pedido</a></li>
                            @endcan                        
                        </ul>
                    </li>
                </ul>
                @endcan
                @can('producto.reporte_cierre.index')
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-archive"></i> <span>Almacén</span>
                        </a>
                        <ul class="dropdown-menu">
                            @can('producto.reporte_cierre.index')
                            <li><a href="{{route('producto.reporte_cierre.index')}}"> Subir Reporte de Cierre - SIGA</a></li>
                            @endcan 
                            @can('reportes.consumo_mensual.total_pedidos_mes')
                            <li><a href="{{route('reportes.consumo_mensual.total_pedidos_mes')}}"> Listado de Productos Solicitados</a></li>
                            @endcan
                            @can('reportes.consumo_mensual.pedidos_oojj_mes')
                            <li><a href="{{route('reportes.consumo_mensual.pedidos_oojj_mes')}}"> Listado de Solicitudes de Pedido</a></li>
                            @endcan
                            @can('pedidos.pecosa.index')
                            <li><a href="{{route('pedidos.pecosa.index')}}">Solicitudes de Pedido</a></li>
                            @endcan 
                            @can('pedidos.pecosa.pedido')
                            <li><a href="{{route('pedidos.pecosa.pedido')}}">Pecosa Realizadas</a></li>
                            @endcan                         
                        </ul>
                    </li>
                </ul>
                @endcan 
                @can('pedidos.transporte.ruta_asignada')
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-truck"></i> <span>Transporte</span>
                        </a>
                        <ul class="dropdown-menu">
                            @can('pedidos.transporte.index')
                            <li><a href="{{route('pedidos.transporte.index')}}"> Asignar fecha de Envio</a></li>
                            @endcan
                            @can('pedidos.transporte.ver_rutas')
                            <li><a href="{{route('pedidos.transporte.ver_rutas')}}"> Ver Rutas Asignadas</a></li>
                            @endcan 
                            @can('pedidos.transporte.ruta_asignada')
                            <li><a href="{{route('pedidos.transporte.ruta_asignada')}}"> Entregar Pecosa</a></li>
                            @endcan                     
                        </ul>
                    </li>
                </ul>
                @endcan
                @can('reportes.consumo_mensual.oojj')
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-line-chart"></i> <span>Gerencia</span>
                        </a>
                        <ul class="dropdown-menu">
                            @can('fullcalendar')
                            <li><a href="{{route('fullcalendar')}}"> Calendario Interno</a></li>
                            @endcan
                            @can('reportes.consumo_mensual.oojj')
                            <li><a href="{{route('reportes.consumo_mensual.oojj')}}"> Consumo Mensual OOJJ</a></li>
                            @endcan
                            @can('reportes.consumo_anual.oojj')
                            <li><a href="{{route('reportes.consumo_anual.oojj')}}"> Consumo Anual OOJJ</a></li>
                            @endcan
                            @can('reportes.consumo_anual.top_producto')
                            <li><a href="{{route('reportes.consumo_anual.top_producto')}}"> Productos más solicitados</a></li>
                            @endcan                        
                        </ul>
                    </li>
                </ul>
                @endcan
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                       
                    @else
                      @can('pedidos.pedidos.index')
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Carrito de Compra <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                            </a>
                          <ul class="dropdown-menu" id="dropdown-menu">
                            <div class="row total-header-section">
                                <div class="col-lg-6 col-sm-6 col-6">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                                </div>
         
                                <?php $total = 0 ?>
                                @foreach((array) session('cart') as $id => $details)
                                    <?php $total += $details['cantidad'] ?>
                                @endforeach
         
                                <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                                    <p>Total: <span class="text-info"> {{ $total }}</span></p>
                                </div>
                            </div>
         
                            @if(session('cart'))
                                @foreach(session('cart') as $id => $details)
                                    <div class="row cart-detail">
                                        <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                            <img src="{{asset('public/img/productos/'.$details['codigo'].'.jpg')}}" /> 
                                        </div>
                                        <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                            <p>{{ $details['descripcion'] }}</p>
                                            <span class="price text-info"> </span> <span class="count"> Cantidad:{{ $details['cantidad'] }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                                    <a href="{{ url('cart') }}" class="btn btn-primary">Mostrar todo</a>
                                </div>
                            </div>
                          </ul>
                        </li>
                      @endcan  
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                              @if (\Auth::user()->foto === null )  
                                <img src="{{asset('img/user.jpg')}}" class="rounded-circle z-depth-0" alt="avatar image" height="20px" width="20px">
                              @else
                                <img src="{{asset('public/img/usuario/'.\Auth::user()->foto) }}" class="rounded-circle z-depth-0" alt="avatar image" height="20px" width="20px">
                              @endif
                                 &nbsp;{{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                @can('acceso.usuario.password')
                                <li><a href="" data-target="#modal-password-{{\Auth::user()->id}}" data-toggle="modal"><i class="fa fa-key" aria-hidden="true"></i> &nbsp;Cambiar Contraseña</a></li>
                                @endcan    
                                @can('acceso.usuario.edit')
                                <li><a href="{{route('acceso.usuario.edit',\Auth::user()->id)}}"><i class="fa fa-user" aria-hidden="true"></i> &nbsp;Editar Perfil</a></li>
                                @endcan
                                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-btn fa-sign-out"></i> Cerrar Sesión</a><form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> {{ csrf_field() }}</form></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- JavaScripts -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
  <br>


  @if(session('info'))
    <div class="container">
      <div class="row">
         <div class="col-md-12">
          <center><div class="alert alert-success">
            {{session('info')}}
          </div></center>
         </div> 
      </div>
    </div>
    @endif
    
    @if(session('infoError'))
    <div class="container">
      <div class="row">
         <div class="col-md-12">
          <center><div class="alert alert-danger">
            {{session('infoError')}} 
          </div></center>
         </div> 
      </div>
    </div>
    @endif
  @yield('content')
    @stack('scripts')
  @include('acceso.usuario.password')
</body>
</html>