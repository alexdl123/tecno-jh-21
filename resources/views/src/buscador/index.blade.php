@extends('layout.app')
@section('contenido')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0" style="color: #1A7CE7"><b>Buscador</b></h1>
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
<div class="col-md-12">
    @can('modulo hotel')
        @can('ver promocion')
        <div class="row pt-2">
            <div class="col-md-12">
                @if ($promociones != null)
                <h4><b>Promociones</b></h4>
                    @foreach ($promociones as $p)
                    <div class="row pt-2"><a href="{{route('promociones')}}">Nombre: {{$p->nombre}}</a></div>
                    @endforeach
                @endif
            </div>
            
        </div>
        @endcan
        @can('ver categoria')
        <div class="row pt-2">
            <div class="col-md-12">
                @if ($categorias != null)
                <h4><b>Categoria</b></h4>
                    @foreach ($categorias as $p)
                    <div class="row pt-2"><a href="{{route('categorias_show', ['id' => $p->id]) }}">Nombre: {{$p->nombre}}
                        Descripcion: {{$p->descripcion}}</a></div>
                    @endforeach
                @endif
            </div>
        </div>
        @endcan

        @can('ver habitacion')
        <div class="row pt-2">
            <div class="col-md-12">
                @if ($habitaciones != null)
                <h4><b>Habitacion</b></h4>
                    @foreach ($habitaciones as $p)
                    <div class="row pt-2"><a href="{{route('habitaciones_show', ['id' => $p->id]) }}">Nro Habitacion: {{$p->nrohabitacion}}
                        Descripcion: {{$p->descripcion}}</a></div>
                    @endforeach
                @endif
            </div>
        </div>
        @endcan
        @can('ver reserva')
        <div class="row pt-2">
            <div class="col-md-12">
                @if ($reservas != null)
                <h4><b>Reserva</b></h4>
                    @foreach ($reservas as $p)
                    <div class="row pt-2"><a href="{{route('reservas_show', ['id' => $p->id]) }}">Descripcion: {{$p->descripcion}}</a></div>
                    @endforeach
                @endif
            </div>
        </div>
        @endcan
    @endcan
    @can('modulo usuario')
        @can('ver personal')
        <div class="row pt-2">
            <div class="col-md-12">
                @if ($usuarios != null)
                <h4><b>Usuario</b></h4>
                    @foreach ($usuarios as $p)
                    <div class="row pt-2"><a href="{{route('usuarios_show', ['id' => $p->id]) }}">Nombre: {{$p->nombre}} Email: {{$p->email}}</a></div>
                    @endforeach
                @endif
            </div>
            
        </div>
        @endcan
        @can('ver huesped')
        <div class="row pt-2">
            <div class="col-md-12">
                @if ($huespedes != null)
                <h4><b>Huesped</b></h4>
                    @foreach ($huespedes as $p)
                    <div class="row pt-2"><a href="{{route('huespedes_show', ['id' => $p->id]) }}">Nombre: {{$p->nombre}} Apellido: {{$p->apellido}}  Telefono: {{$p->telefono}}</a></div>
                    @endforeach
                @endif
            </div>
            
        </div>
        @endcan
    @endcan
</div>
@endsection