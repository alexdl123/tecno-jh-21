@extends('layout.app')

@section('contenido')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0" style="color: #1A7CE7"><b>Reporte</b></h1>
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
        <div class="card-body">
            <div class="rows pt-2">
                <div class="col-md-12">
                    <label>Huesped</label>
                    <div id="bar_huespedes"></div>
                </div>
            </div>
            <div class="rows pt-2">
                <div class="col-md-12">
                    <label>Reserva</label>
                    <div id="bar_reservas"></div>
                </div>
            </div>
            <div class="rows pt-2">
                <div class="col-md-12">
                    <label>Actividad</label>
                    <div id="bar_actividades"></div>
                </div>
            </div>
        </div>
    <div>
</div>
@endsection
@push('scripts')
<!-- Morris Charts JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.3.0/raphael.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.js"></script>

<script>
    var huespedes = <?php echo json_encode($huespedes );?>;
    var reservas = <?php echo json_encode($reservas );?>;
    var actividades = <?php echo json_encode($actividades );?>;

    $(document).ready(function() {
       var barUsuarios = Morris.Bar({
            element: 'bar_huespedes',
            data: huespedes,
            xkey: 'y',
            ykeys: ['a'],
            labels: ['Huespedes'],
            barColors: ["#2196F3"],
            xLabelMargin: 10,
            hideHover: 'auto',
            resize: true
        });
        var barEmpresas = Morris.Bar({
            element: 'bar_reservas',
            data: reservas,
            xkey: 'y',
            ykeys: ['a'],
            labels: ['Reservas'],
            barColors: ["#5cb85c"],
            xLabelMargin: 10,
            hideHover: 'auto',
            resize: true
        });
        var barAct = Morris.Bar({
            element: 'bar_actividades',
            data: actividades,
            xkey: 'y',
            ykeys: ['a'],
            labels: ['Actividades'],
            barColors: ["#B29215"],
            xLabelMargin: 10,
            hideHover: 'auto',
            resize: true
        });

        
                 //   barUsuarios.redraw();
                 //   barEmpresas.redraw();
                  //  barAct.redraw();
                /*    $(window).trigger('resize');
                    break;
                case "#tab-info-6":
                    barAcc.redraw();
                    $(window).trigger('resize');
                    break;*/
        
       
    });

</script>
@endpush