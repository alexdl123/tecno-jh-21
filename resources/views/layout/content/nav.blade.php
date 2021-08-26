<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow @yield('fuente') @yield('tamano') @yield('nav-var')">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars @yield('txt')"></i>
    </button>

    <!-- Topbar Search -->
    <form action="{{ route('buscar') }}" method="POST" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
    @csrf
        <div class="input-group">
            <input name="dato" id="dato" type="text" required class="form-control bg-light border-0  @yield('tamano')" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
            <button class="btn btn-primary" type="submit">
                <i class="fas fa-search fa-sm"></i>
            </button>
            </div>
        </div>
    </form>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
    <li class="nav-item dropdown no-arrow d-sm-none">
        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-search fa-fw"></i>
        </a>
        <!-- Dropdown - Messages -->
        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                    
        <form action="{{ route('buscar') }}" method="POST">
             @csrf
            <div class="input-group">
                <input type="text" name="dato"  required class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>

        </form>
        </div>
    </li>

  
   

    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->nombre}} </span>
            @if(Auth::user()->foto == null)
                <img class="img-profile rounded-circle" src=" {{ asset('plantilla/assets/img/avatar1.png')}}">
            @else
            <img class="img-profile rounded-circle" src="{{Auth::user()->foto}}">
            @endif
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        <!-- <a class="dropdown-item  @yield('tamano')" href="#">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            Perfil
        </a> -->
        <a class="dropdown-item  @yield('tamano')" href="{{ url('/configuraciones') }}">
            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
            Configuracion
        </a>
        
        <div class="dropdown-divider"></div>
        <a class="dropdown-item  @yield('tamano')" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Cerrar Sesion
        </a>
        </div>
    </li>

    </ul>

</nav>