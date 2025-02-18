@php
    // Establecer el ID del modal, usando 'ModalRegistro' como valor por defecto
    $modalId = isset($modalId) ? $modalId : 'ModalRegistro';
@endphp

<div class="modal fade" id="{{ $modalId }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    {{ $title }}
                    <small class="m-0 text-muted">
                        {{ $description }}
                    </small>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmRegistro">
                    {{ $slot }}
                </form>
            </div>

            @if (isset($form))
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="button" id="btnRegistro"></button>
                </div>
            @else
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">cerrar</button>
                </div>
            @endif

        </div>
    </div>
</div>