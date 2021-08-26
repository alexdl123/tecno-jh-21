@extends('layout.app')

@section('contenido')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0" style="color: #1A7CE7"><b>Habitacion</b></h1>
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
                <a href="{{route('habitaciones')}}" class="btn ripple btn-3d btn-primary" style='float:right'>
                    <div><span>Atras</span></div>
                </a>
            </div>
            
                <div class="card-body">
                    
                    <div class="row pt-2">
                        <div class="col-lg-6">
                            <label for="nrohabitacion_habitacion">Nro Habitacion</label>
                                <input class="form-control" placeholder="Escriba el nro habitacion.." value="{{$habitacion->nrohabitacion}}"
                                    name="nrohabitacion_habitacion" id="nrohabitacion_habitacion" type="number" disabled>
                        </div>
                        <div class="col-lg-6">
                            <label for="">Categoria</label>
                            <input class="form-control" name="categoria" type="text" disabled value="{{$categoria->nombre}}">
                                                         
                        </div>
                    </div>
                    <div class="row pt-2">
                        <div class="col-lg-6">
                        <label for="descripcion_habitacion">Descripcion</label>
                                <textarea class="form-control" placeholder="Escriba el descripcion.." disabled
                                   row="4" name="descripcion_habitacion" id="descripcion_habitacion" type="text">{{$habitacion->descripcion}}</textarea>                                    
                        </div>
                        <div class="col-lg-6">
                            <label for="">Estado</label>
                            <input class="form-control" name="categoria" type="text" disabled value="{{$habitacion->estado}}">
                                                         
                        </div>
                    </div>
                    
                    
                </div>
            
        </div>
    </div>
</div>
@endsection
