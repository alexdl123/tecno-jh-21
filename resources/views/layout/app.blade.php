<!DOCTYPE html>
<html lang="en">
    @include('layout.content.head')
    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">
            @include('layout.content.sidebar')
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column @yield('fuente') @yield('tamano') @yield('body')">

                <!-- Main Content -->
                <div id="content" style=" ">
                    @include('layout.content.nav')
                    <div class="container-fluid">
                        @yield('contenido')
                        
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- End of Main Content -->
            @include('layout.content.footer')
            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade @yield('fuente')  @yield('tamano') " id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Estas Seguro de Cerrar Sesion?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                </div>
                <div class="modal-body">Selecciona "Cerrar sesion" abajo si esta estas seguro de cerrar tu sesion actual.</div>
                <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();" >Cerrar Sesion</a>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
            </div>
        </div>
            @include('layout.content.script')
        
    </body>

</html>