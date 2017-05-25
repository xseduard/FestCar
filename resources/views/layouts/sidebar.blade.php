<!-- Left side column. contains the sidebar -->


<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar", id="navegacion">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">

             <img src="
            @if (Auth::user()->role=='administrador')
                {{asset('/bower_components/admin-lte/dist/img/userADMIN.jpg')}}
            @else
                {{asset('/bower_components/admin-lte/dist/img/user4-128x128.jpg')}}
            @endif
               " class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p> {{ Auth::user()->nombres }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> En linea</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Buscar..."/>
<span class="input-group-btn">
  <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
</span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">MENU</li>
            <!-- Optionally, you can add icons to the links -->
            <li ruta="home"><a href="{{ url('/home') }}"><span>Inicio</span></a></li>
            
          




            <li ruta="admin"><a href="{{ url('/admin') }}"><span>Admin</span></a></li>
            <li ruta="forma"><a href="{{ url('/forma') }}"><span>Formas</span></a></li>
           <!-- <li class="active"><a href="#"><span>Link Activo</span></a></li>
            
            <li class="treeview">
                <a href="#"><span>Multilevel</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#">Link in level 2</a></li>
                    <li><a href="#">Link in level 2</a></li>
                </ul>
            </li>
            -->
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
