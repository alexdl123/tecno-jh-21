<div class="modal fade" id="exampleModal-{{$c->id}}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form id="form" action="{{route('reservas_delete', ['id' => $c->id]) }}" class="form" method="post">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="pregunta">
                    Esta seguro de anular reserva
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">Cancelar</button>
                    <button type="submit" id=""
                        class="btn btn-primary">Confirmar</button>
                </div>
            </div>
        </div>
    </form>
</div>