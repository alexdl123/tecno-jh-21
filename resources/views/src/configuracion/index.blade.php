@extends('layout.app')

@section('contenido')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0" style="color: #1A7CE7"><b>Configuracion</b></h1>
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
    <div class="col-md-6 col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Fuentes</h6>
            </div>
            <form role="form" method="post" action="{{route('fuente')}}">
                @csrf
                <div class="card-body">
                    <div class="col-sm-12 padding-0 letra_programador">
                        <input type="radio" name="fuente" value="3"
                            {{Auth::user()->tipo_letra == 3 ?  'checked' : ''}}>
                            Courier
                    </div>
                    <div class="col-sm-12 padding-0 letra_divertido">
                        <input type="radio" name="fuente" value="2"
                            {{Auth::user()->tipo_letra == 2?  'checked' : ''}}>
                            Comic Sans MS
                    </div>
                    <div class="col-sm-12 padding-0 letra_tradicional">
                        <input type="radio" name="fuente" value="1"
                            {{Auth::user()->tipo_letra == 1?  'checked' : ''}}>
                            Helvetica
                    </div>
                    
                    <div class="d-flex flex-row-reverse">
                        <div class="col-lg-4">
                            <button type="submit" class="btn ripple btn-3d btn-primary">
                                <div><span>Confirmar</span></div>
                            </button>
                        </div>
                    </div>
                    
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-6 col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tamaño de Letra</h6>
            </div>
            <form role="form" method="post" action="{{route('tamano')}}">
                @csrf
                <div class="card-body">
                    <div class="col-sm-12 padding-0 chico">
                        <input type="radio" name="tamano" value="1"
                            {{Auth::user()->tamano == 1 ?  'checked' : ''}}>
                            Small
                    </div>
                    <div class="col-sm-12 padding-0 mediano">
                        <input type="radio" name="tamano" value="2"
                            {{Auth::user()->tamano == 2?  'checked' : ''}}>
                            Medium
                    </div>
                    <div class="col-sm-12 padding-0 grande">
                        <input type="radio" name="tamano" value="3"
                            {{Auth::user()->tamano == 3?  'checked' : ''}}>
                            Large
                    </div>
                    <div class="d-flex flex-row-reverse">
                        <div class="col-lg-4">
                            <button type="submit" class="btn ripple btn-3d btn-primary">
                                <div><span>Confirmar</span></div>
                            </button>
                        </div>
                    </div>
                    
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Fuentes</h6>
            </div>
            <form role="form" method="post" action="{{route('tema')}}">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4 padding-0">
                            <input type="radio" name="tema" value="1"
                                {{Auth::user()->tema == 1 ?  'checked' : ''}}>
                                Default
                        </div>
                        <div class="col-sm-4 padding-0">
                            <input type="radio" name="tema" value="2"
                                {{Auth::user()->tema == 2?  'checked' : ''}}>
                                Diurno
                        </div>
                        <div class="col-sm-4 padding-0">
                            <input type="radio" name="tema" value="3"
                                {{Auth::user()->tema == 3?  'checked' : ''}}>
                                Nocturno
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 padding-0">
                            <input type="radio" name="tema" value="4"
                                {{Auth::user()->tema == 4?  'checked' : ''}}>
                                Infantil
                        </div>
                        <div class="col-sm-4 padding-0">
                            <input type="radio" name="tema" value="5"
                                {{Auth::user()->tema == 5?  'checked' : ''}}>
                                Joven
                        </div>
                        <div class="col-sm-4 padding-0">
                            <input type="radio" name="tema" value="6"
                                {{Auth::user()->tema == 6?  'checked' : ''}}>
                                Adulto
                        </div>
                    </div>
                    <div class="d-flex flex-row-reverse">
                        <div class="col-lg-4 pt-4">
                            <button type="submit" class="btn ripple btn-3d btn-primary">
                                <div><span>Confirmar</span></div>
                            </button>
                        </div>
                    </div>
                    
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
