<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Bootstrap -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
  
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/jquery-toggles/css/toggles.css')}}">
   <link rel="stylesheet" type="text/css" href="{{asset('vendors/jquery-toggles/css/themes/toggles-all.css')}}">

    
    <!-- NProgress -->
    <link href="{{asset('vendors/nprogress/nprogress.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
  
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/switchery/dist/switchery.min.css')}}">

  </head>
  @yield('styles')

  <body class="nav-md footer_fixed">
  <style type="text/css">
  footer{
    z-index: 1000 !important;
  }
  .no_selection{
    -webkit-user-select: none;  
    -moz-user-select: none;    
    -ms-user-select: none;      
    user-select: none;
  }
  #logout_btn{
    background: none !important;
    color: inherit;
    border: none;
    padding: 0! important;
    font: inherit;
    cursor: pointer;
    outline: inherit !important;
    margin-left: 0em !important;
  }
  footer{
  }
  .right_col{
  }
  </style>
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{route('dashboard')}}" class="site_title"><i class="fa fa-user-md"></i> <span>Clínica Ramis</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{ asset('/user_avatars/'.Auth::user()->avatar) }}" alt="Avatar" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Bienvenido,</span>
                <h2>{{Auth::user()->name}}</h2>
              </div>
              <div class="clearfix"></div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                      <li class="{{ Route::currentRouteNamed('dashboard') ? 'current-page' : '' }}"><a href="{{route('dashboard')}}"><i class="fa fa-home"></i>Inicio</a></li>
                    
                  </li>
@if(
  Auth::user()->can('crear_pacientes')
  ||Auth::user()->can('eliminar_pacientes')
  ||Auth::user()->can('modificar_pacientes')
  ||Auth::user()->can('ver_pacientes')
  )

<li class="{{ Route::currentRouteNamed('patients_index')||Route::currentRouteNamed('new_patient_form')||Route::currentRouteNamed('show_patient_details')||Route::currentRouteNamed('patients_search') ? 'active' : '' }}"><a><i class="fa fa-users"></i> Pacientes <span class="fa fa-chevron-down"></span></a>

<ul class="nav child_menu">
  <li class="{{ Route::currentRouteNamed('patients_index')||Route::currentRouteNamed('show_patient_details')||Route::currentRouteNamed('new_patient_form')||Route::currentRouteNamed('edit_patient_form')||Route::currentRouteNamed('patients_search') ? 'current-page' : '' }}"><a href="{{route('patients_index')}}" >Administración de pacientes</a></li>
</ul>

</li>
@endif
@if(
  Auth::user()->hasRole('administrador')
  ||Auth::user()->can('crear_usuarios')
  ||Auth::user()->can('ver_usuarios')
  ||Auth::user()->can('modificar_usuarios')
  ||Auth::user()->can('eliminar_usuarios')
)
                  <li class="{{ Route::currentRouteNamed('admin_users_index')||Route::currentRouteNamed('new_user_form') ? 'active' : '' }}"><a><i class="fa fa-cogs"></i> Administración <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
@if(
  Auth::user()->can('crear_usuarios')
  ||Auth::user()->can('ver_usuarios')
  ||Auth::user()->can('modificar_usuarios')
  ||Auth::user()->can('eliminar_usuarios')
)                      
                      <li class="{{ Route::currentRouteNamed('admin_users_index') ? 'current-page' : '' }}"><a href="{{route('admin_users_index')}}">Gestión de usuarios</a></li>
@endif


@role('administrador')
                      <li class="{{ Route::currentRouteNamed('roles_permissions_index') ? 'current-page' : '' }}"><a href="{{route('roles_permissions_index')}}" >Roles & permisos</a></li>
                    </ul>
@endrole
                  </li>
@endif
              </div>
            </div>
            <!-- /sidebar menu -->

          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    
                    <img src="{{ asset('/user_avatars/'.Auth::user()->avatar) }}" alt="">{{Auth::user()->name}}
                    
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;">Ver perfil</a></li>
                    <!--
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    -->
                    <li>
                    <a href="#" onclick="cerrar_sesion()">Cerrar sesión
                    </a>
                    </li>
                  </ul>
                </li>
              </ul>

            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->

        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>@yield('title')</h3>
              </div>

            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>@yield('panel_title')</h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      @yield('content')
                      <div class="clearfix"><br></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
          <div class="clearfix"></div>
        <footer>
          <div class="pull-right">
            Clínica Ramis - MAD 2017
          </div>
        
        </footer>
        
        <!-- /footer content -->
      </div>
    </div>

    <form method="POST" id="end_sesion_form" style="display: none" action="{{route('logout')}}">
      {{csrf_field()}}
    </form>



    
<!-- jQuery -->
    <script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>
     <!-- JsCookie-->
    <script type="text/javascript" src="{{asset('js/js.cookie.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('vendors/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{asset('vendors/nprogress/nprogress.js')}}"></script>
    
    <!--moment -->
    <script src="{{asset('vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('vendors/moment/locale/es.js')}}"></script>

    <!-- datetimepicker -->
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')}}">
    <script src="{{asset('vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>



    <!-- daterangepicker -->
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/bootstrap-daterangepicker/daterangepicker.css')}}">
    <script src="{{asset('vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

    <script src="{{asset('vendors/jquery-toggles/toggles.min.js')}}"></script>
    <!-- Custom Theme Scripts -->
    <script src="{{asset('js/custom.js')}}"></script>

    <!-- jquery.inputmask -->
    <script src="{{asset('vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js')}}"></script>


    <!-- Switchery -->
    <script src="{{asset('vendors/switchery/dist/switchery.min.js')}}"></script>

   
    <script type="text/javascript">


      function set_menu(collapse){
        if (collapse==1){
          $('.current-page::before').parent().addClass("jajaja");//css('display','none');
          $SIDEBAR_MENU.find('li.active ul').hide();
          $SIDEBAR_MENU.find('li.active').addClass('active-sm').removeClass('active');
          $BODY.removeClass('nav-md');
          $BODY.addClass('nav-sm');
          $('.dataTable').each ( function () { $(this).dataTable().fnDraw(); });
        }else{
          $SIDEBAR_MENU.find('li.active-sm ul').show();
          $SIDEBAR_MENU.find('li.active-sm').addClass('active').removeClass('active-sm');
          $BODY.removeClass('nav-sm');
          $BODY.addClass('nav-md');
          $('.dataTable').each ( function () { $(this).dataTable().fnDraw(); });
        }
      }

      function cerrar_sesion(){
        document.getElementById("end_sesion_form").submit();
      }

      @yield('scripts')
      $(document).ready(function(){
        var collapsed_sidebar=Cookies.get('collapsed_sidebar');
        if(collapsed_sidebar==1){
          set_menu(1);
        }else{
          set_menu(0);
        }
        @yield('ready_scripts')
      });
    </script>

    
   

  </body>
</html>
