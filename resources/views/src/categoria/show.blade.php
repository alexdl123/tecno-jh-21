@extends('layout.app')

@section('contenido')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0" style="color: #1A7CE7"><b>Categoria</b></h1>
</div>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{route('categorias')}}" class="btn ripple btn-3d btn-primary" style='float:right'>
                    <div><span>Atras</span></div>
                </a>
            </div>
            <div class="card-body">
                <div class="row pt-2">
                    <div class="col-lg-6">
                        <label for="">Nombre</label>
                        <input class="form-control" value="{{$categoria->nombre}}"
                            name="color_categoria" id="color_categoria" type="text" disabled>
                        <label for="descripcion_categoria">Descripcion</label>
                        
                        <textarea class="form-control"
                            name="descripcion_categoria" disabled type="text" rows="4">
                            {{$categoria->descripcion}}
                        </textarea>
                        
                    </div>
                    <div class="col-lg-6 col-md-6">
                        @if($categoria->img == null)
                            <label for="imagen_">Imagen</label>
                            <input class="form-control" value="No tiene imagen" name="imagen_"
                                type="text" disabled>
                            @else
                            <img src="{{$categoria->img}}" alt="" width="500px" height="300px">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection