@extends('layout.app')

@section('contenido')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0" style="color: #1A7CE7"><b>Huesped</b></h1>
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
                <a href="{{route('huespedes')}}" class="btn ripple btn-3d btn-primary" style='float:right'>
                    <div><span>Atras</span></div>
                </a>
            </div>
            <form method="post" action="{{route('huespedes_update', ['id' => $huesped->id])}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                <input type="hidden" value="{{$huesped->id}}">
                    <div class="row pt-2">
                        <div class="col-lg-6">
                            <label for="nombre_huesped">Nombre</label>
                                <input class="form-control" placeholder="Escriba el nombre.." required
                                    name="nombre_huesped" id="nombre_huesped" type="text" value="{{$huesped->nombre}}">

                            <label for="apellido_huesped">Apellido</label>
                                <input class="form-control" placeholder="Escriba el apellido.." required
                                    name="apellido_huesped" id="apellido_huesped" type="text" value="{{$huesped->apellido}}">
                            <label for="ci_huesped">Ci</label>
                                <input class="form-control" placeholder="Escriba el ci.."
                                    name="ci_huesped" id="ci_huesped" type="number" value="{{$huesped->ci}}">
                            <label for="telefono_huesped">Telefono</label>
                                <input class="form-control" min="0" placeholder="Escriba el telefono.." required
                                    name="telefono_huesped" id="telefono_huesped" type="number" value="{{$huesped->telefono}}">
                            <br>
                            <label for="imagen_usuario">Imagen</label>
                            <input type="file" name="imagenes[]" id="imagen_usuario"
                                accept="image/x-png,image/gif,image/jpeg">
                        </div>
                    
                        <div class="col-lg-6">
                            <div class="row" id="imagenes_prev">
                            </div>
                            @if($usuario->foto != [null])
                                <img src="{{$usuario->foto}}" alt="" width="500px" height="300px" id="cat_imagen">
                            @endif
                        </div>

                    </div>
                    <input type="hidden" name="habitacionHuesped" value="{{ $habitacionHuesped }}" />
                    @if (!$habitacionHuesped)
                        <h4 class="info">No tiene habitacion</h4>
                        <div class="col-lg-6">
                            <label for="habitacionid">Habitacion</label>
                            <select class="form-control" name="habitacionid">
                                @foreach ($habitaciones as $key => $v)
                                    <option value="{{$v->id}}">Habitacion Nro {{$v->nrohabitacion}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label for=""></label>
                            <br>
                            <label for="nota">Nota</label>
                                <input class="form-control" placeholder="Notas" required
                                    name="nota" id="nota" type="text">
                        </div>
                        <br>
                        <div class="col-lg-6">
                            <label><strong>Desocupar</strong></label>
                            <input type="checkbox" name="desocupar" />                    
                        </div>
                    @else
                        <div class="col-lg-6">
                            <label for="habitacionid">Habitacion</label>
                            <select class="form-control" name="habitacionid">
                                @foreach ($habitaciones as $key => $v)
                                    @if ($v->id == $habitacionHuesped->habitacion_id)
                                        <option value="{{$v->id}}" selected>Habitacion Nro {{$v->nrohabitacion}}</option>
                                    @else
                                        <option value="{{$v->id}}">Habitacion Nro {{$v->nrohabitacion}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label for=""></label>
                            <br>
                            <label for="nota">Nota</label>
                                <input class="form-control" placeholder="Notas" required
                                    name="nota" id="nota" value="{{ $habitacionHuesped == null ? '' : $habitacionHuesped->nota }}" type="text">
                        </div>
                        <br>
                        <div class="col-lg-6">
                            <label><strong>Desocupar</strong></label>
                            <input type="checkbox" name="desocupar" />                    
                        </div>
                    @endif
                    
                    <!-- <div class="row pt-2">
                        <div class="col-lg-6">
                            <label for="">Datos Usuario</label>
                            <br>
                            <label for="nombre_usuario">Nick</label>
                                <input class="form-control" placeholder="Escriba el nombre.." required
                                    name="nombre_usuario" id="nombre_usuario" type="text" value="{{$usuario->nombre}}">

                        </div>
                        <div class="col-lg-6">
                            <label for=""></label>
                            <br>
                            <label for="email_usuario">Email</label>
                                <input class="form-control" placeholder="Escriba el email.." required
                                    name="email_usuario" id="email_usuario" type="text" value="{{$usuario->email}}">
                        </div>
                    </div>
                    <div class="row pt-2">
                        <div class="col-lg-12">
                            <label for="password_usuario">Password</label>
                                <input class="form-control" placeholder="Escriba el password.." required
                                    name="password_usuario" id="password_usuario" type="password">
                        </div>
                    </div> -->
                    <div class="row pt-2">
                        <div class="col-md-2 right">
                            <!-- <button id="btn_submit" class="btn ripple btn-3d btn-primary">
                                <div><span>Guardar</span></div>
                            </button> -->
                            <button type="submit" class="btn ripple btn-primary">
                                Guardar
                            </button>    
                            <button type="reset" class="btn ripple btn-3d btn-danger">
                                <div><span>Limpiar</span></div>
                            </button>
                        </div>
                    </div>
                    
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
<!-- @push('scripts') -->
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
                        $('#cat_imagen').css('display', 'none');
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