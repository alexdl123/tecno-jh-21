<!-- Footer -->
<footer class="sticky-footer bg-white  @yield('tamano') @yield('footer')">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
        <span class=" @yield('tamano')">Copyright &copy; Your Website 2019</span>
        
        </div>
        <div class="copyright text-right my-auto">
            <span class=" @yield('tamano')" style="">Contador : {{$contador}}</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->