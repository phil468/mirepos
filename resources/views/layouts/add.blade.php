<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIAD - Poder Judicial</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    
    <style type="text/css">
      #img1 {
      border-radius: 50%;
      margin-top: 30px;
    }
      #italic {
      font-style: italic;
      text-transform: uppercase;
    }
    </style>

  </head>
  <body class="hold-transition skin-red sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="{{route('home')}}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>SIAD</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>SIAD</b></span>
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <small class="fa fa-circle" style="color:#00FF00"></small>
                  <span class="hidden-xs">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu">
                  @if (\Auth::user()->foto === null )  
                  <!-- User image -->
                    <center><img id="img1" src="{{asset('img/user.jpg')}}" height="120px" width="120px"></center>       
                  @else
                    <center><img id="img1" src="{{asset('public/img/usuario/'.\Auth::user()->foto) }}" height="120px" width="120px"></center>
                  @endif
                  <p>
                    <center>{{ Auth::user()->name }}</center>
                  </p>
                  <center><a href="{{ asset('manuales/general.pdf') }}" target=»_blank»>Manual de Usuario</a></center>  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      @can('acceso.usuario.edit')
                        <a href="{{route('acceso.usuario.edit',\Auth::user()->id)}}"><i class="fa fa-address-card"></i>Ajustar Perfil</a>
                      @endcan
                    </div>
                    <div class="pull-right">
                      <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> Cerrar Sesión</a><form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> {{ csrf_field() }}</form>
                    </div>
                  </li>
                </ul>
              </li>              
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
                    
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
             @if (\Auth::user()->foto === null )  
              <!-- User image -->
                <center><img class="img-responsive img-rounded" id="img1" src="{{asset('img/user.jpg')}}" height="120px" width="120px"></center>       
              @else
                <center><img class="img-responsive img-rounded" id="img1" src="{{asset('public/img/usuario/'.\Auth::user()->foto) }}" height="120px" width="120px"></center>
              @endif
            <br>
            <li class="treeview">
              <a href="#">
                <center><span id="italic"> {{ Auth::user()->name}}</span></center>
              </a>
            </li>   
            @can('acceso.usuario.index')
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i> <span>Informática</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                
                @can('poder_judicial.sedes.index')
                <li><a href="{{route('poder_judicial.sedes.index')}}"><i class="fa fa-circle-o"></i> Sedes</a></li>
                @endcan
                @can('poder_judicial.oojj.index')
                <li><a href="{{route('poder_judicial.oojj.index')}}"><i class="fa fa-circle-o"></i> OOJJ</a></li>
                @endcan
                @can('producto.categoria.index')
                <li><a href="{{route('producto.categoria.index')}}"><i class="fa fa-circle-o"></i> Categoria</a></li>
                @endcan
                @can('producto.producto.index')
                <li><a href="{{route('producto.producto.index')}}"><i class="fa fa-circle-o"></i> Producto</a></li>
                @endcan
                @can('acceso.usuario.index')
                <li><a href="{{route('acceso.usuario.index')}}"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                @endcan
                @can('acceso.roles.index')
                <li><a href="{{route('acceso.roles.index')}}"><i class="fa fa-circle-o"></i>Roles</a></li>
                @endcan
                @can('acceso.permisos.index')
                <li><a href="{{route('acceso.permisos.index')}}"><i class="fa fa-circle-o"></i>Permisos</a></li>
                @endcan
              </ul>
            </li>
            @endcan 
            @can('pedidos.pedidos.index')
            <li class="treeview">
              <a href="#">
                <i class="fa fa-university"></i> <span>Administración de Sedes</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                @can('pedidos.pedidos.index')
                <li><a href="{{route('pedidos.pedidos.index')}}"><i class="fa fa-circle-o"></i> Realizar Solicitud de Pedido</a></li>
                @endcan

                
                
              </ul>
            </li>
            @endcan 
            @can('producto.reporte_cierre.index')
            <li class="treeview">
              <a href="#">
                <i class="fa fa-archive"></i> <span>Almacén</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                @can('producto.reporte_cierre.index')
                <li><a href="{{route('producto.reporte_cierre.index')}}"><i class="fa fa-circle-o"></i> Subir Reporte de Cierre</a></li>
                @endcan 
                @can('reportes.consumo_mensual.total_pedidos_mes')
                <li><a href="{{route('reportes.consumo_mensual.total_pedidos_mes')}}"><i class="fa fa-circle-o"></i> Listado de Productos Solicitados</a></li>
                @endcan
                @can('reportes.consumo_mensual.pedidos_oojj_mes')
                <li><a href="{{route('reportes.consumo_mensual.pedidos_oojj_mes')}}"><i class="fa fa-circle-o"></i> Listado de Solicitudes de Pedido</a></li>
                @endcan
                @can('pedidos.pecosa.index')
                <li><a href="{{route('pedidos.pecosa.index')}}"><i class="fa fa-circle-o"></i>Solicitudes de Pedido</a></li>
                @endcan 
                @can('pedidos.pecosa.pedido')
                <li><a href="{{route('pedidos.pecosa.pedido')}}"><i class="fa fa-circle-o"></i>Pecosa Realizadas</a></li>
                @endcan 
              </ul>
            </li>
            @endcan 
            @can('pedidos.transporte.index')
            <li class="treeview">
              <a href="#">
                <i class="fa fa-truck"></i> <span>Transporte</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                @can('pedidos.transporte.index')
                <li><a href="{{route('pedidos.transporte.index')}}"><i class="fa fa-circle-o"></i> Asignar fecha de Envio</a></li>
                @endcan
                @can('pedidos.transporte.ver_rutas')
                <li><a href="{{route('pedidos.transporte.ver_rutas')}}"><i class="fa fa-circle-o"></i> Ver Rutas Asignadas</a></li>
                @endcan
              </ul>
            </li>
            @endcan 
            @can('pedidos.transporte.ruta_asignada')
            <li class="treeview">
              <a href="#">
                <i class="fa fa-truck"></i> <span>Entrega Pecosa</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                @can('pedidos.transporte.ruta_asignada')
                <li><a href="{{route('pedidos.transporte.ruta_asignada')}}"><i class="fa fa-circle-o"></i> Rutas Asignadas</a></li>
                @endcan
              </ul>
            </li>
            @endcan 
            @can('reportes.consumo_mensual.oojj')
            <li class="treeview">
              <a href="#">
                <i class="fa fa-line-chart"></i> <span>Gerencia</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                @can('fullcalendar')
                <li><a href="{{route('fullcalendar')}}"><i class="fa fa-circle-o"></i> Calendario Interno</a></li>
                @endcan
                @can('reportes.consumo_mensual.oojj')
                <li><a href="{{route('reportes.consumo_mensual.oojj')}}"><i class="fa fa-circle-o"></i> Consumo Mensual OOJJ</a></li>
                @endcan
                @can('reportes.consumo_anual.oojj')
                <li><a href="{{route('reportes.consumo_anual.oojj')}}"><i class="fa fa-circle-o"></i> Consumo Anual OOJJ</a></li>
                @endcan
                @can('reportes.consumo_anual.top_producto')
                <li><a href="{{route('reportes.consumo_anual.top_producto')}}"><i class="fa fa-circle-o"></i> Productos más solicitados</a></li>
                @endcan
              </ul>
            </li>
            @endcan
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>





       <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
          
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              
                <div id= "border" class="box-header with-border">
                  <h3 class="box-title">Sistema Integrado de Almacenamiento y Distribución</h3>
                  
                </div>
                <!-- /.box-header -->
                  	<div class="row">
	                  	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                          <!--Contenido-->
                              @if(session('info'))
                                <div class="row">
                                   <div class="col-md-8 col-md-offset-2">
                                    <center><div class="alert alert-success">
                                      {{session('info')}}
                                    </div></center>
                                   </div> 
                                </div>
                              @endif
                              
                              @if(session('infoError'))
                                <div class="row">
                                   <div class="col-md-8 col-md-offset-2">
                                    <center><div class="alert alert-danger">
                                      {{session('infoError')}} 
                                    </div></center>
                                   </div> 
                                </div>
                              @endif
                              @yield('content')
                              
		                          <!--Fin Contenido-->
                           </div>
                        </div>
		                    
                  		</div>
                  	</div><!-- /.row -->
                <!-- /.box-body -->
              <!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->
      <footer id="border" class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2019 <a href="#">Poder Judicial</a>.</strong> Todos los derechos reservados
      </footer>

      
    <!-- jQuery 2.1.4 -->
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    @stack('scripts')
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>
    
    
  </body>
</html>
