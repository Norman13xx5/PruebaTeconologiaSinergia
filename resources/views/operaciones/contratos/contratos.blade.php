@extends('layouts.dashboard')

@section('title', 'Contratos')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Tabla de Contratos
                    </h2>
                    <div class="panel-toolbar">
                        <button type="button" class="btn btn-info active" onclick="showModalRegistro('Contrato', true);">
                            Agregar <i class="fal fa-plus-square"></i>
                        </button>
                    </div>
                </div>
                <x-DataTable>
                    <th>Id</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de Finalización</th>
                    <th>Titulo del Contrato</th>
                    <th>Representante</th>
                    <th>Telefono</th>
                    <th>Correo Electronico</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </x-DataTable>
            </div>
        </div>
    </div>
@endsection

@push('modals')
    <x-ModalForm title="Agregar Contrato" description="Un contrato es la alianza que hace un tercero con la empresa." form>
        <div class="form-row">
            <div class="input-group col-md-6 mb-3">
                <input type="text" class="form-control" id="fechaInicio" name="fechaInicio"
                    placeholder="Fecha de inicio del Contrato" data-inputmask="'mask': '99/99/9999'" im-insert="true">
                <div class="input-group-append">
                    <span class="input-group-text fs-xl">
                        <i class="fal fa-calendar-check"></i>
                    </span>
                </div>
            </div>
            <div class="input-group col-md-6 mb-3">
                <input type="text" class="form-control" id="fechaFin" name="fechaFin"
                    placeholder="Fecha de vencimiento del Contrato" data-inputmask="'mask': '99/99/9999'" im-insert="true">
                <div class="input-group-append">
                    <span class="input-group-text fs-xl">
                        <i class="fal fa-calendar-check"></i>
                    </span>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label" for="titulo">Titulo del Contrato</label>
                <input type="text" onKeyPress="if(this.value.length==800)return false;" class="form-control"
                    id="titulo" name="titulo" placeholder="Nombres del contrato" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label" for="representante">Representante del Contrato</label>
                <input type="text" onKeyPress="if(this.value.length==70)return false;" class="form-control"
                    id="representante" name="representante" placeholder="Represente del contrato" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label" for="telefono">Telefono de Contacto</label>
                <input type="number" onKeyPress="if(this.value.length==10)return false;" class="form-control"
                    id="telefono" name="telefono" placeholder="Telefono de Contacto" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label" for="email">Correo de Contacto</label>
                <input type="email" onKeyPress="if(this.value.length==100)return false;" class="form-control"
                    id="email" name="email" placeholder="Correo de Contacto del contrato" required>
            </div>
            <x-InputBase file title="Documentación del Contrato" label="Adjuntar Archido de Documentacón" accept=".pdf"
                span="Archivo de documentación formato pdf." />
        </div>
    </x-ModalForm>
@endpush

@push('scripts')
    <script>
        $(document).ready(async () => {
            await buildDataTable("contratos",
                [{
                        data: "id"
                    },
                    {
                        data: "fechaInicio"
                    },
                    {
                        data: "fechaFin"
                    },
                    {
                        data: "titulo"
                    },
                    {
                        data: "representante"
                    },
                    {
                        data: "telefono"
                    },
                    {
                        data: "email"
                    },
                    {
                        data: "status"
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]);
            $("#fechaInicio, #fechaFin").datepicker({
                orientation: "buttom left",
                todayHighlight: true,
                templates: vars.controls,
            });
        });

        const crearRegistro = async (form) => {
            await buildCreateRegister("api/contratos", form);
        };

        const editarRegistro = async (id) => {
            await buildEditRegister(id, "api/contratos",
                [
                    "fechaInicio",
                    "fechaFin",
                    "titulo",
                    "representante",
                    "telefono",
                    "email",
                    "archivo",
                ], true);
        }

        const statusRegistro = async (id) => {
            await buildStatusRegister(id, "api/contratos");
        };

        const eliminarRegistro = async (id) => {
            await buildDeleteRegister(id, "api/contratos");
        };
    </script>
@endpush
