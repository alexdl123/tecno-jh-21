@extends('layout.app')

@section('contenido')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0" style="color: #1A7CE7"><b>Reserva</b></h1>
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
                <a href="{{route('reservas')}}" class="btn ripple btn-3d btn-primary" style='float:right'>
                    <div><span>Atras</span></div>
                </a>
            </div>
            
                <div class="card-body">
                    
                    <div class="row pt-2">
                        <div class="col-lg-6">
                            <label for="nrohabitacion_habitacion">Huesped</label>
                                <input class="form-control" name="huesped" disabled
                                 value="{{$huesped->nombre}} {{$huesped->apellido}}" type="text">
                                   
                        </div>
                        @if($promocion != null)
                        <div class="col-lg-6">
                            <label for="">Promocion</label>
                            <input class="form-control" name="huesped" disabled type="text"
                                 value="{{$promocion->nombre}}">                             
                        </div>
                        @endif
                    </div>
                    <div class="row pt-2">
                        <div class="col-lg-6">
                            <label for="">Fecha ingreso:</label>
                            <input class="form-control"  disabled value="{{$reserva->fecha_ingreso}}" name="fechaingreso_reserva" type="text" required>
                        </div>
                        <div class="col-lg-6">
                            <label for="">Fecha salida:</label>
                            <input class="form-control"  disabled type="text" value="{{$reserva->fecha_salida}}">
                        </div>
                    </div>
                    
                    <div class="row pt-2">
                        <div class="col-lg-12">
                        <label for="descripcion_reserva">Descripcion</label>
                                <textarea class="form-control" placeholder="Escriba el descripcion.." disabled
                                   row="4" name="descripcion_reserva" id="descripcion_reserva" type="text">{{$reserva->descripcion}}</textarea>                                    
                        </div>
                    </div>
                    <div class="row pt-2">
                        <div class="col-lg-12">
                            <label for="">Habitaciones:</label>
                        </div>
                    </div>
                    <div class="row pt-2">
                        <div class="col-lg-12">
                            @foreach ($habitacion as $h)
                            <label class="col-md-6 col-lg-4">
                                <input type="text" class="form-control" 
                                    value="{{$h->nrohabitacion}} Categoria: {{$h->nombre}}" disabled>
                            </label>
                            @endforeach
                            
                        </div>
                    </div>
                    
                    
                </div>
            
        </div>
    </div>
</div>
@endsection
