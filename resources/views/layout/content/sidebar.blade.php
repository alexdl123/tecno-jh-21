<ul class="navbar-nav sidebar sidebar-dark accordion @yield('fuente') @yield('tamano') @yield('sidebar')" id="accordionSidebar" style="">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/home') }}">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink @yield('txt')"></i>
        </div>
        <div class="sidebar-brand-text mx-3 @yield('tamano') @yield('txt')">Residencial Mi Segundo Hogar</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0 @yield('boton')">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="{{ url('/home') }}">
          <i class="fas fa-home @yield('txt')"></i>
          <span class=" @yield('tamano') @yield('txt')">Home</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider @yield('boton')">

      <!-- Heading -->
     
      <!-- Nav Item - Utilities Collapse Menu -->
      @can('modulo usuario')
      <li class="nav-item @yield('tamano')">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-users @yield('txt')"></i>
          <span class=" @yield('tamano') @yield('txt')">Usuarios</span>
          @if ( Auth::user()->tema == 2)
          <i class="fas fa-angle-down @yield('txt')" style="float: right;"></i>
          @endif
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header  @yield('tamano') @yield('txt')">Componentes:</h6>
            @can('ver personal')
            <a class="collapse-item  @yield('tamano') @yield('txt')" href="{{route('usuarios')}}">Usuario</a>
            @endcan
            @can('ver huesped')
            <a class="collapse-item  @yield('tamano') @yield('txt')" href="{{route('huespedes')}}">Huesped</a>
            @endcan
          </div>
        </div>
      </li>
      @endcan
      <!-- Nav Item - Pages Collapse Menu -->
      @can('modulo hotel')
      <li class="nav-item @yield('tamano')">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-hotel @yield('txt')"></i>
          <span class=" @yield('tamano') @yield('txt')">Hotel</span>
          @if ( Auth::user()->tema == 2)
          <i class="fas fa-angle-down @yield('txt')" style="float: right;"></i>
          @endif
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header  @yield('tamano') @yield('txt')">Componentes:</h6>
            @can('ver categoria')
            <a class="collapse-item  @yield('tamano') @yield('txt')" href="{{route('categorias')}}">Categoria</a>
            @endcan
            @can('ver plan')
            <a class="collapse-item  @yield('tamano') @yield('txt')" href="{{route('planes')}}">Opciones</a>
            @endcan
            @can('ver habitacion')
            <a class="collapse-item  @yield('tamano') @yield('txt')" href="{{route('habitaciones')}}">Habitaciones</a>
            <a class="collapse-item  @yield('tamano') @yield('txt')" href="{{route('ingreso_salida_index')}}">Ingreso Salida</a>
            @endcan
            <a class="collapse-item  @yield('tamano') @yield('txt')" href="{{route('mensajes')}}">Mensajes</a>
            @can('ver reserva')
            <a class="collapse-item  @yield('tamano') @yield('txt')" href="{{route('reservas')}}">Reservas</a>
            @endcan
            <a class="collapse-item  @yield('tamano') @yield('txt')" href="{{route('promociones')}}">Promociones</a>
          </div>
        </div>
      </li>
    @endcan
      

      <!-- Divider -->
      <hr class="sidebar-divider @yield('boton')">

      <!-- Heading -->
      

      <!-- Nav Item - Pages Collapse Menu -->
      @can('modulo seguridad')
      <li class="nav-item">
        <a class="nav-link collapsed @yield('tamano') @yield('txt')" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-lock @yield('txt')"></i>
          <span class="@yield('tamano')">Seguridad</span>
          @if ( Auth::user()->tema == 2)
          <i class="fas fa-angle-down @yield('txt')" style="float: right;"></i>
          @endif
        </a>
        <div id="collapsePages" class="collapse @yield('tamano') @yield('txt')" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded @yield('txt')">
            <h6 class="collapse-header  @yield('tamano') @yield('txt')">Componentes:</h6>
            @can('ver bitacora')
            <a class="collapse-item  @yield('tamano') @yield('txt')" href="{{route('bitacoras')}}">Bitacora</a>
            @endcan
            @can('ver reporte')
            <a class="collapse-item  @yield('tamano')" href="{{route('reportes')}}">Reportes y <br> Estadisticas</a>
            @endcan
        </div>
      </li>
      @endcan
   

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0 @yield('boton')" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->