@extends('layout.app')

@section('contenido')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0" style="color: #1A7CE7"><b>Mensaje</b></h1>
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
                <a href="{{route('mensajes')}}" class="btn ripple btn-3d btn-primary" style='float:right'>
                    <div><span>Atras</span></div>
                </a>
            </div>
            <form role="form" method="post" action="{{route('mensajes_update', ['id' => $mensaje->id])}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row pt-2">
                        <div class="col-lg-3">
                            <label for="fecha">Titulo</label>
                            <input class="form-control" required
                                name="titulo" type="text" value="{{ $mensaje->titulo }}">
                        </div>
                        <div class="col-lg-6">
                            <label for="contenido">Contenido</label>
                            <textarea class="form-control" required
                                name="contenido" id="contenido" type="text">
                                {{ $mensaje->contenido }}
                            </textarea>
                        </div>
                        <div class="col-lg-3">
                            <label for="type">Huespeds</label>
                            <select class="form-control" name="huesped_id">
                                @foreach ($huespeds as $huesped)
                                    @if ($huesped->id == $mensaje->huesped_id)
                                        <option value="{{$huesped->id}}" selected>{{$huesped->nombre}} {{$huesped->apellido}}</option>
                                    @else
                                        <option value="{{$huesped->id}}">{{$huesped->nombre}} {{$huesped->apellido}}</option>
                                    @endif
                                @endforeach
                            </select>                    
                        </div>
                    </div>
                    <div class="row pt-2">
                        <div class="col-md-2 right">
                            <button id="btn_submit" class="btn ripple btn-3d btn-primary">
                                <div><span>Guardar</span></div>
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
@push('scripts')
<script>
    
    var cont = 1;

    var obs = false;
    
    var imagenes_b = false;

    $(function(){
        $("#imagen_categoria").change(function () {
            var images = $("#imagen_categoria").val();
            if(images == null){
                //error
                imagenes_b = false;
            }else{
                var files = $('#imagen_categoria')[0].files; 
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