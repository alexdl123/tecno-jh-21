<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Residencial Mi Segundo Hogar</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('plantilla/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <!-- <link rel="stylesheet" type="text/css" href="{{asset('plantilla/css/datatables.bootstrap.min.css')}}" /> -->
  <link href="{{ asset('plantilla/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <!--<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">-->
  <link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('plantilla/css/sb-admin-2.min.css')}}" rel="stylesheet">
  <style>
		 /* body { background-color: #2196F3 !important; 
          font-family: "Comic Sans MS", "Comic Sans", cursive !important;}*/
      .diurno {
            background-color: #FFFFFF !important;
      }
      .diurnoLetra {
        color: #000000 !important;
      }

      .nocturno {
          background: #1e1e2f !important;
          /* font-family: 'Lemonada', cursive !important; */
          /* font-family: 'Poppins', sans-serif !important; */
          /* color: #fff !important; */
      }
      .nocturnosuave {
        background: #2E3233 !important;
      }
      .chico {
          font-size: small !important;
      }
      .mediano {
          font-size: medium !important;
      }
      .grande {
          font-size: large !important;
      }
      .letra_programador {
         font-family: courier !important;
      }
      .letra_divertido {
         font-family: "Comic Sans MS", "Comic Sans", cursive !important;
      }
      .letra_tradicional {
        font-family: "Source Sans Pro", "Helvetica Neue", Helvetica, Arial, sans-serif !important;

      }
      .joven {
        background-image: url("plantilla/assets/img/ANTISOLAR.jpg")
      }
      .nino {
        background-image: url("plantilla/assets/img/parque.jpg");
      }
      .adulto {
        background-image: url("plantilla/assets/img/pexels-photo-189296.jpeg");
      }
      .normal {
        background: #9EE0F3 !important;
      }
      .normalSidebar {
        background: #2196F3 !important;
      }
  </style>

</head>
@if ( Auth::user()->tipo_letra == 1)
    @section('fuente', 'letra_tradicional')
@endif
@if ( Auth::user()->tipo_letra == 2)
    @section('fuente', 'letra_divertido')
@endif
@if ( Auth::user()->tipo_letra == 3)
    @section('fuente', 'letra_programador')
@endif

@if ( Auth::user()->tamano == 1)
    @section('tamano', 'chico')
@endif
@if ( Auth::user()->tamano == 2)
    @section('tamano', 'mediano')
@endif
@if ( Auth::user()->tamano == 3)
    @section('tamano', 'grande')
@endif
@if ( Auth::user()->tema == 1)
    @section('nav-var', 'normal')
    @section('body', '')
    @section('sidebar', 'normalSidebar')
    @section('txt', '')
    @section('boton', '')
    @section('footer', '')
@endif
@if ( Auth::user()->tema == 2)
    @section('nav-var', 'diurno')
    @section('body', '')
    @section('sidebar', 'diurno')
    @section('txt', 'text-dark')
    @section('boton', 'nocturno')
    @section('footer', '')
@endif
@if ( Auth::user()->tema == 3)
    @section('nav-var', 'nocturno')
    @section('body', 'nocturnosuave')
    @section('sidebar', 'nocturno')
    @section('txt', '')
    @section('boton', '')
    @section('footer','nocturno')
@endif
@if ( Auth::user()->tema == 4)
    @section('nav-var', 'nino')
    @section('body', '')
    @section('sidebar', 'nino')
    @section('txt', '')
    @section('boton', '')
    @section('footer','')
@endif
@if ( Auth::user()->tema == 5)
    @section('nav-var', 'joven')
    @section('body', '')
    @section('sidebar', 'joven')
    @section('txt', '')
    @section('boton', '')
    @section('footer','')
@endif
@if ( Auth::user()->tema == 6)
    @section('nav-var', 'adulto')
    @section('body', '')
    @section('sidebar', 'adulto')
    @section('txt', '')
    @section('boton', '')
    @section('footer','')
@endif