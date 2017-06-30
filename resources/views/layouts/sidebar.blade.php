<aside class="main-sidebar" id="sidebar-wrapper">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                @if(!Auth::user()->role == 'autorizador_emdisalud')
                    <img  src="{{ asset('/multimedia/profiles/default.png') }}" class="user-image" alt="imagen de usuario"/>
                @else
                    <img  src="{{ asset('/multimedia/profiles/logo_emdi.png') }}" class="user-image" alt="imagen de usuario"/>
                @endif 
            </div>
            <div class="pull-left info">
                @if (Auth::guest())
                <p>Invitado</p>
                @else
                    <p>{{ Auth::user()->nombres}}</p>
                @endif
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> En linea</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Buscar..."/>
          <span class="input-group-btn">
            <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
            </div>
        </form>
        <!-- Sidebar Menu -->

        <ul class="sidebar-menu">
            @include('layouts.menu')
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>