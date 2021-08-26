@extends('layout.app')

@section('contenido')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0" style="color: #1A7CE7"><b>Usuario</b></h1>
</div>
<div class="col-md-12">
    @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif
</div>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{route('usuarios')}}" class="btn ripple btn-3d btn-primary" style='float:right'>
                    <div><span>Atras</span></div>
                </a>
            </div>
            
                <div class="card-body">
                    
                    <div class="row pt-2">
                        <div class="col-lg-6">
                        <label for="nombre_usuario">Nombre</label>
                                <input class="form-control" placeholder="Escriba el nombre.." disabled
                                    name="nombre_usuario" id="nombre_usuario" type="text" value="{{$usuario->nombre}}">

                            <label for="email_usuario">Email</label>
                                <input class="form-control" placeholder="Escriba el email.." disabled
                                    name="email_usuario" id="email_usuario" type="text" value="{{$usuario->email}}">
                               
                            <br>
                            
                                
                        </div>
                    
                        <div class="col-lg-6">
                        @if($usuario->foto == null)
                            <label for="imagen_">Imagen</label>
                            <input class="form-control" value="No tiene imagen" name="imagen_"
                                type="text" disabled>
                            @else
                            <img src="{{$usuario->foto}}" alt="" width="500px" height="300px">
                        @endif
                        </div>
                    </div>
                                     
                </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    
    var cont = 1;

    var obs = false;
    
    var imagenes_b = false;

    $(function(){
        $("#imagen_usuario").change(function () {
            var images = $("#imagen_usuario").val();
            if(images == null){
                //error
                imagenes_b = false;
            }else{
                var files = $('#imagen_usuario')[0].files; 
                $('#imagenes_prev').empty();
                for (var i = 0, f; f = files[i]; i++) {
                    console.log('looop');
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var imagen = '<div class="col-md-6"><img src="'+e.target.result+'" alt="imagen" style="width: 500px; height: auto;"></div>'
                        $('#imagenes_prev').append(imagen);
                        // $('#blah').attr('src', e.target.result); 
                    }
                    reader.readAsDataURL(f);
                }
                imagenes_b = true;
            }           
        });
    });
</script>
@endpush