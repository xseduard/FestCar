<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="{{ url('/home') }}" class="logo"><b>T</b>ranseba</a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                                @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Iniciar sesion</a></li>
                        <li><a href="{{ url('/register') }}">Registrarse</a></li>
                    @else
                        
                   
                <li class="dropdown messages-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        <span class="label label-success">5</span>
                    </a>

                    <ul class="dropdown-menu">
                        <li class="header">Tienes 5 mensajes</li>
                        <li>
                            <!-- inner menu: contains the messages -->
                            <ul class="menu">
                                <li><!-- start message -->
                                    <a href="#">
                                        <div class="pull-left">
                                            <!-- User Image -->
                                            <img src="{{ asset("/bower_components/admin-lte/dist/img/user3-128x128.jpg") }}" class="img-circle" alt="User Image"/>
                                        </div>
                                        <!-- Message title and timestamp -->
                                        <h4>
                                            Equipo de soporte
                                            <small><i class="fa fa-clock-o"></i> 36 minutos</small>
                                        </h4>
                                        <!-- The message -->
                                        <p>nuevos cambios para ss?</p>
                                    </a>
                                </li><!-- end message -->
                            </ul><!-- /.menu -->
                        </li>
                        <li class="footer"><a href="#">Ver todos los mensajes</a></li>
                    </ul>
                </li><!-- /.messages-menu -->

                <!-- Notifications Menu -->
                <li class="dropdown notifications-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">23</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">Tienes 23 notificaciones</li>
                        <li>
                            <!-- Inner Menu: contains the notifications -->
                            <ul class="menu">
                                <li><!-- start notification -->
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i> 5 nuevos miembros se han registrados en el dia
                                    </a>
                                </li><!-- end notification -->
                            </ul>
                        </li>
                        <li class="footer"><a href="#">Ver todo</a></li>
                    </ul>
                </li>
                <!-- Tasks Menu -->
                <li class="dropdown tasks-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag-o"></i>
                        <span class="label label-danger">99</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">Tienes 99 tareas</li>
                        <li>
                            <!-- Inner menu: contains the tasks -->
                            <ul class="menu">
                                <li><!-- Task item -->
                                    <a href="#">
                                        <!-- Task title and progress text -->
                                        <h3>
                                            Diseño sistema forms
                                            <small class="pull-right">20%</small>
                                        </h3>
                                        <!-- The progress bar -->
                                        <div class="progress xs">
                                            <!-- Change the css width attribute to simulate progress -->
                                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">20% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li><!-- end task item -->
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="#">Ver todas las tareas</a>
                        </li>
                    </ul>
                </li>
                <!-- User Account Menu -->

                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="                        
                            @if (Auth::user()->role=='administrador')
                                {{asset('/bower_components/admin-lte/dist/img/userADMIN.jpg')}}
                            @else
                                {{asset('/bower_components/admin-lte/dist/img/user4-128x128.jpg')}}
                            @endif

                        " class="user-image" alt="User Image"/>
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{{ Auth::user()->nombres  }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img src="
                            @if (Auth::user()->role=='administrador')
                                {{asset('/bower_components/admin-lte/dist/img/userADMIN.jpg')}}
                            @else
                                {{asset('/bower_components/admin-lte/dist/img/user4-128x128.jpg')}}
                            @endif
                            " class="img-circle" alt="User Image" />
                            <p>
                                {{ Auth::user()->nombres, Auth::user()->apellidos }} - {{ Auth::user()->role }} 
                                {{ Auth::user()->email }}
                                <small>Miembro desde {{ Auth::user()->created_at }}.</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#">Seguidores</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Sales</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Amigos</a>
                            </div>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Perfil</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Cerrar session</a>
                            </div>
                        </li>
                    </ul>
                </li>
                 @endif
            </ul>
        </div>
    </nav>
</header>