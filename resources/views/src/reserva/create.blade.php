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
            <form role="form" method="post" action="{{route('reservas_store')}}">
                @csrf
                <div class="card-body">
                    
                    <div class="row pt-2">
                        <div class="col-lg-6">
                            <label for="nrohabitacion_habitacion">Huesped</label>
                                <select class="form-control" name="huesped">
                                    @foreach ($huesped as $key => $v)
                                    <option value="{{$v->id}}">{{$v->nombre}} {{$v->apellido}}</option>
                                    @endforeach
                                </select> 
                        </div>
                        <div class="col-lg-6">
                            <label for="">Promocion</label>
                            <select class="form-control" name="promocion">
                                <option value="">Ninguno</option>
                                @foreach ($promocion as $key => $v)
                                <option value="{{$v->id}}">{{$v->nombre}}</option>
                                @endforeach
                            </select>                                
                        </div>
                    </div>
                    <div class="row pt-2">
                        <div class="col-lg-6">
                            <label for="">Fecha ingreso:</label>
                            <input class="form-control" id="fechaingreso_reserva" name="fechaingreso_reserva" type="date" required>
                        </div>
                        <div class="col-lg-6">
                            <label for="">Fecha salida:</label>
                            <input class="form-control" id="fechasalida_reserva" name="fechasalida_reserva" type="date" required>
                        </div>
                    </div>
                    
                    <div class="row pt-2">
                        <div class="col-lg-12">
                        <label for="descripcion_reserva">Descripcion</label>
                                <textarea class="form-control" placeholder="Escriba el descripcion.." required
                                   row="4" name="descripcion_reserva" id="descripcion_reserva" type="text"></textarea>                                    
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
                                <input type="checkbox" name="habitacion[]"
                                    value="{{$h->id}}">   {{$h->nrohabitacion}} Categoria: {{$h->nombre}}
                            </label>
                            @endforeach
                            
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
