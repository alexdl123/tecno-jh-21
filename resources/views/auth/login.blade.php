@extends('layouts.app')

@section('content')
<div class="row justify-content-center" style='padding-top:200px'>
</div>
<div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block" style="background-image: url('plantilla/assets/img/habitacion.jpg');"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Iniciar Sesion</h1>
                  </div>
                  <form class="user" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                      <input type="email" class="form-control-user form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" aria-describedby="emailHelp" placeholder="Correo"
                        value="{{ old('email') }}" name="email" required autofocus>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control-user form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" placeholder="Password">
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                    
                  </form>
                 
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
    @php
    if(file_exists(storage_path('login.txt'))){
    $file = File::get(storage_path('login.txt'));
    $file = (int)$file;
    $file++;
    File::put(storage_path('login.txt'), $file);
    }else{
    $file = 1;
    File::put(storage_path('login.txt'), $file);
    }
    @endphp
    <footer class="sticky-footer">
      <div class="container my-auto">
          
          <div class="copyright text-right my-auto">
              <b style="">Contador : {{$file}}</b>
          </div>
      </div>
  </footer>
<!-- End of Footer -->
    @endsection