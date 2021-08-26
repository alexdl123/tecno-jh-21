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
<div class="col-md-12">
    <div class="card shadow mb-4">
        @can('crear huesped')
            <div class="card-header py-3">
                <a href="{{route('huespedes_create')}}" class="btn ripple btn-3d btn-success" style='float:right'>
                    <div><span>Agregar</span></div>
                </a>
            </div>
        @endcan
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTables">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Telefono</th>
                            <th>Estado</th>
                            <th>Habitacion</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($huesped as $c)
                        <tr class="odd gradeX">
                            <td>{{$c->id}}</td>
                            <td>{{$c->nombre}} {{$c->apellido}}</td>
                            <td>{{$c->email}}</td>
                            <td>{{$c->telefono}}</td>
                            <td>{{$c->estado != null ? 'Con habitacion' : 'Sin habitacion'}}</td>
                            <td>{{$c->nrohabitacion != null ? 'Con habitacion' : 'Sin habitacion'}}</td>
                            <td>
                                @can('ver huesped')
                                    <a href="{{route('huespedes_show', ['id' => $c->id]) }}"
                                            class="btn btn-primary btn-xs">Ver</a>
                                @endcan
                                @can('editar huesped')
                                    <a href="{{route('huespedes_edit', ['id' => $c->id]) }}"
                                        class="btn btn-warning btn-xs">Editar</a>
                                @endcan
                                @can('eliminar huesped')
                                    <a type="button" data-toggle="modal" data-target="#exampleModal-{{$c->id}}"
                                        class="btn btn-danger btn-xs">Eliminar</a>
                                    @include('src.huesped.delete')
                                @endcan 
                                @if ($c->estado != null)
                                    <a href="{{route('ingreso_salida_create', ['id' => $c->id])}}" class="btn btn-primary btn-xs">Registrar Ingreso Salida</a>
                                @endif                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>               
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        var tabla = $('#dataTables').DataTable({
                responsive: true
        });

    })
</script>
@endpush