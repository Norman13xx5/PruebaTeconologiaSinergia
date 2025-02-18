<div class="frame-wrap bg-white m-3">
    <div class="custom-control custom-checkbox custom-control-inline p-2">
        <h5><b>Modulo de {{ $page }}</b></h5>
    </div>
    <div class="custom-control custom-checkbox custom-control-inline m-3">
        <input type="checkbox" class="custom-control-input" id="r-{{ $page }}"
            name="permissions[{{ $page }}][read]">
        <label class="custom-control-label" for="r-{{ $page }}">Leer</label>
    </div>
    <div class="custom-control custom-checkbox custom-control-inline m-3">
        <input type="checkbox" class="custom-control-input" id="w-{{ $page }}"
            name="permissions[{{ $page }}][write]">
        <label class="custom-control-label" for="w-{{ $page }}">Escribir</label>
    </div>
    <div class="custom-control custom-checkbox custom-control-inline m-3">
        <input type="checkbox" class="custom-control-input" id="u-{{ $page }}"
            name="permissions[{{ $page }}][update]">
        <label class="custom-control-label" for="u-{{ $page }}">Actualizar</label>
    </div>
    <div class="custom-control custom-checkbox custom-control-inline m-3">
        <input type="checkbox" class="custom-control-input" id="d-{{ $page }}"
            name="permissions[{{ $page }}][delete]">
        <label class="custom-control-label" for="d-{{ $page }}">Eliminar</label>
    </div>
</div>
