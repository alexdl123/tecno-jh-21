<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Residencial Mi Segundo Hogar</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('onepage/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('onepage/css/animate.css') }}">
    
    <link rel="stylesheet" href="{{ asset('onepage/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('onepage/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('onepage/css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('onepage/css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('onepage/css/ionicons.min.css') }}">
    
    <link rel="stylesheet" href="{{ asset('onepage/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('onepage/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('onepage/css/style.css') }}">
  </head>
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
  	<div class="py-1 bg-black top" style="background-color: #459CFA">
    	<div class="container">
    		<div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
	    		<div class="col-lg-12 d-block">
		    		<div class="row d-flex">
		    			<div class="col-md pr-4 d-flex topper align-items-center">
					    	<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
						    <span class="text">+ 591 736 87 125</span>
					    </div>
					    <div class="col-md pr-4 d-flex topper align-items-center">
					    	<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
						    <span class="text">rmi_segundo_hogar@gmail.com</span>
					    </div>
					    
				    </div>
			    </div>
		    </div>
		  </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light site-navbar-target" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.html">Residencial Mi Segundo Hogar</a>
	      <button class="navbar-toggler js-fh5co-nav-toggle fh5co-nav-toggle" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav nav ml-auto">
	          <li class="nav-item"><a href="#home-section" class="nav-link"><span>Inicio</span></a></li>
	          <li class="nav-item"><a href="#about-section" class="nav-link"><span>Acerca Nosotros</span></a></li>
	          <li class="nav-item"><a href="#contact-section" class="nav-link"><span>Contactanos</span></a></li>
			  @if (Route::has('login'))
			  	@auth
				  <li class="nav-item cta mr-md-2"><a href="{{ url('/home') }}" class="nav-link">Home</a></li>
				@else
					<li class="nav-item cta mr-md-2"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
				@endauth
			  @endif
	        </ul>
	      </div>
	    </div>
	  </nav>
	  
	  <section class="hero-wrap js-fullheight" style="background-image: url('plantilla/assets/img/pexels-photo-189296.jpeg');" data-section="home" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
          <div class="col-md-6 pt-5 ftco-animate">
          	<div class="mt-5">
          		<span class="subheading">Bienvenido al Residencial Mi Segundo Hogar</span>
	            <h1 class="mb-4">Estamos aqui<br>para brindarle el mejor servicio</h1>
	          
	        </div>
          </div>
        </div>
      </div>
    </section>

	<section class="ftco-counter img ftco-section ftco-no-pt ftco-no-pb" id="about-section">
		<div class="container">
			<div class="row d-flex">
				<div class="col-md-6 col-lg-5 d-flex">
					<div class="img d-flex align-self-stretch align-items-center" style="background-image:url(plantilla/assets/img/habitacion.jpg);">
					</div>
				</div>
				<div class="col-md-6 col-lg-7 pl-lg-5 py-md-5">
					<div class="py-md-5">
						<div class="row justify-content-start pb-3">
						  <div class="col-md-12 heading-section ftco-animate p-4 p-lg-5">
							<h2 class="mb-4">Nosotros somos el Residencial<span> Mi Segundo Hogar </span></h2>
							<p>Sabemos que un ambiente ideal para los negocios de nuestros clientes es parte de su éxito, por este motivo le ofrecemos un lugar donde la elegancia, el confort y la modernidad se complementan 
							con un trato personalizado y un servicio de primera 
							que harán de su estadía la clave de su éxito.</p>
							
						  </div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </section>


		

    <section class="ftco-intro img" style="background-image: url(images/bg_2.jpg);">
			<div class="overlay"></div>
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-9 text-center">
						<h2>Tu comodidad y bienestar es nuestra prioridad</h2>
						
					</div>
				</div>
			</div>
		</section>

		
    
  

    <section class="ftco-section contact-section" id="contact-section">
      <div class="container">
      	<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <h2 class="mb-4">Contactanos</h2>
          </div>
        </div>
        <div class="row d-flex contact-info mb-5">
          <div class="col-md-6 col-lg-3 d-flex ftco-animate">
          	<div class="align-self-stretch box p-4 text-center bg-light">
          		<div class="icon d-flex align-items-center justify-content-center">
          			<span class="icon-map-signs"></span>
          		</div>
          		<h3 class="mb-4">Direccion</h3>
	            <p>Av. Cumavi No. 371</p>
	          </div>
          </div>
          
          <div class="col-md-6 col-lg-3 d-flex ftco-animate">
          	<div class="align-self-stretch box p-4 text-center bg-light">
          		<div class="icon d-flex align-items-center justify-content-center">
          			<span class="icon-paper-plane"></span>
          		</div>
          		<h3 class="mb-4">Email</h3>
	            <p><a href="mailto:hotel_balcones@gmail.com">rmi_segundo_hogar@gmail.com</a></p>
	          </div>
          </div>
         
			<div class="col-md-6 col-lg-6 d-flex ftco-animate">
				<div id="map" class="bg-white" style='height: 350px'></div>
			</div>
        
      </div>
    </section>

    <footer class="ftco-footer">
    	<div class="overlay"></div>
      	<div class="container-fluid">
       
        <div class="row">
          <div class="col-md-12 text-center">
		  	@php
                if(file_exists(storage_path('welcome.txt'))){
                $file = File::get(storage_path('welcome.txt'));
                $file = (int)$file;
                $file++;
                File::put(storage_path('welcome.txt'), $file);
                }else{
                $file = 1;
                File::put(storage_path('welcome.txt'), $file);
                }
                @endphp
            	<p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> 
					Grupo 9 SC
				   <i class="icon-heart color-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
  				</p>
			<p style="text-align: right">Contador : {{$file}}</p>

          </div>
        </div>
      </div>
    </footer>

<!-- grupo09sc
grup009grup009 -->

<!-- mail.tecnoweb.org.bo -->

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="{{ asset('onepage/js/jquery.min.js') }}"></script>
  <script src="{{ asset('onepage/js/jquery-migrate-3.0.1.min.js') }}"></script>
  <script src="{{ asset('onepage/js/popper.min.js') }}"></script>
  <script src="{{ asset('onepage/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('onepage/js/jquery.easing.1.3.js') }}"></script>
  <script src="{{ asset('onepage/js/jquery.waypoints.min.js') }}"></script>
  <script src="{{ asset('onepage/js/jquery.stellar.min.js') }}"></script>
  <script src="{{ asset('onepage/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('onepage/js/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ asset('onepage/js/aos.js') }}"></script>
  <script src="{{ asset('onepage/js/jquery.animateNumber.min.js') }}"></script>
  <script src="{{ asset('onepage/js/scrollax.min.js') }}"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="{{ asset('onepage/js/google-map.js') }}"></script>
  
  <script src="{{ asset('onepage/js/main.js') }}"></script>
    
  </body>
</html>