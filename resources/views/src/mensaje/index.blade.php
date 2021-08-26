@extends('layout.app')

@section('contenido')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0" style="color: #1A7CE7"><b>Mensajes</b></h1>
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
        <div class="card-header py-3">
            <a href="{{route('mensajes_create')}}" class="btn ripple btn-3d btn-success" style='float:right'>
                <div><span>Agregar</span></div>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTables">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Titulo Hora</th>
                            <th>Contenido</th>
                            <th>Fecha Hora</th>
                            <th>Huesped</th>
                            <th>Remitente</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mensajes as $c)
                        <tr class="odd gradeX">
                            <td>{{$c->id}}</td>
                            <td>{{$c->titulo}}</td>
                            <td>{{$c->contenido}}</td>
                            <td>{{$c->fechahora}}</td>                   
                            <td>{{$c->huesped->nombre}} {{$c->huesped->apellido}}</td>
                            <td>{{$c->by}}</td>                 
                            <td>
                                <a href="{{route('mensajes_edit', ['id' => $c->id]) }}"
                                class="btn btn-warning btn-xs">Editar</a>
                                <a type="button" data-toggle="modal" data-target="#exampleModal-{{$c->id}}"
                                        class="btn btn-danger btn-xs">Eliminar</a>
                                    @include('src.mensaje.delete')
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