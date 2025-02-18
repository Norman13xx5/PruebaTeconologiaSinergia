@extends('layouts.dashboard')

@section('title', 'Formulario de Permisos')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Formulario de Permisos al rol {{ $rol }} con id {{ $id }}
                    </h2>
                    <div class="panel-toolbar">
                        <a class="btn btn-info mr-1" href="{{ route('roles') }}">
                            <i class="fal fa-arrow-left"></i>
                            Regresar
                        </a>
                        <button class="btn btn-primary ml-1" type="button" onclick="guardarPermisos('frmPermisos');">
                            Guardar Permisos
                            <i class="fal fa-save"></i>
                        </button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <form id="frmPermisos" class="text-center">
                            <x-Permisos page="roles" />
                            <x-Permisos page="empresas" />
                            <x-Permisos page="usuarios" />
                            <x-Permisos page="acuerdos" />
                            <x-Permisos page="contratos" />
                            <x-Permisos page="maquinarias" />
                            <x-Permisos page="materiales" />
                            <x-Permisos page="rutas" />
                            <x-Permisos page="registros" />
                            <x-Permisos page="informes" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const guardarPermisos = async (form) => {
            const formData = new FormData(document.getElementById(form));
            formData.append("_method", "PUT");

            for (const [key, value] of formData.entries()) {
                console.log(`${key}: ${value}`);
            }
        };
    </script>
@endpush
