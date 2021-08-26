@extends('layout.app')

@section('contenido')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0" style="color: #1A7CE7"><b>Opciones</b></h1>
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
        @can('crear plan')
            <div class="card-header py-3">
                <a href="{{route('planes_create')}}" class="btn ripple btn-3d btn-success" style='float:right'>
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
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($plan as $c)
                        <tr class="odd gradeX">
                            <td>{{$c->id}}</td>
                            <td>{{$c->nombre}}</td>
                            <td>
                                
                                @can('editar plan')
                                    <a href="{{route('planes_edit', ['id' => $c->id]) }}"
                                        class="btn btn-warning btn-xs">Editar</a>
                                @endcan
                                @can('eliminar plan')
                                    <a type="button" data-toggle="modal" data-target="#exampleModal-{{$c->id}}"
                                        class="btn btn-danger btn-xs">Eliminar</a>
                                    @include('src.plan.delete')
                                @endcan
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