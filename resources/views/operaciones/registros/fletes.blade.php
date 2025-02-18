@extends('layouts.dashboard')

@section('title', 'Registros Fletes')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Tabla de Registros Fletes
                    </h2>
                    <div class="panel-toolbar">
                        <a class="btn btn-primary mr-1" href="{{ route('registros') }}">
                            <i class="fal fa-arrow-left"></i>
                            Regresar
                        </a>
                        <button type="button" class="btn btn-info active ml-1" onclick="showModalRegistro('Flete');">
                            Agregar <i class="fal fa-plus-square"></i>
                        </button>
                    </div>
                </div>
                <x-DataTable>
                    <th>id</th>
                    <th>Cod. Ficha</th>
                    <th>Manifiesto</th>
                    <th>Placa o Nro Registro</th>
                    <th>Valor Flete</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha Final</th>
                    <th>Titulo del Contrato</th>
                    <th>Observación</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </x-DataTable>
            </div>
        </div>
    </div>
@endsection

@push('modals')
    <x-ModalForm title="Agregar Registro de Flete"
        description="Un registro es la información de la operación que realizo una maquinaria." form>
        <div class="form-row">
            <input type="hidden" id="modulo" name="modulo" value="fletes">
            <div class="col-md-3 mb-3">
                <label class="form-label" for="codFicha">Cod Ficha</label>
                <input type="text" onKeyPress="if(this.value.length==200)return false;" class="form-control"
                    id="codFicha" name="codFicha" placeholder="Codigo de la ficha del registro" required>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label" for="manifiesto">Manifiesto</label>
                <input type="text" onKeyPress="if(this.value.length==191)return false;" class="form-control"
                    id="manifiesto" name="manifiesto" placeholder="Manifiesto de la ficha del registro" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label" for="manifiesto">Manifiesto</label>
                <input type="text" onKeyPress="if(this.value.length==200)return false;" class="form-control"
                    id="manifiesto" name="manifiesto" placeholder="Manifiesto del registro" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Placa o # de Registro:</label>
                <select class="custom-select form-control" id="idMaquinaria" name="idMaquinaria">
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Contrato:</label>
                <select class="custom-select form-control" id="idContrato" name="idContrato">
                </select>
            </div>
            <div class="input-group col-md-6 mb-3">
                <input type="text" class="form-control" id="fechaInicio" name="fechaInicio" placeholder="Fecha de Inicio"
                    data-inputmask="'mask': '99/99/9999'" im-insert="true">
                <div class="input-group-append">
                    <span class="input-group-text fs-xl">
                        <i class="fal fa-calendar-check"></i>
                    </span>
                </div>
            </div>
            <div class="input-group col-md-6 mb-3">
                <input type="text" class="form-control" id="fechaFin" name="fechaFin" placeholder="Fecha Final"
                    data-inputmask="'mask': '99/99/9999'" im-insert="true">
                <div class="input-group-append">
                    <span class="input-group-text fs-xl">
                        <i class="fal fa-calendar-check"></i>
                    </span>
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <label class="form-label" for="observacion">Observacion del Registro</label>
                <textarea onKeyPress="if(this.value.length==1000)return false;" class="form-control" id="observacion" name="observacion"
                    rows="5" style="height: 77px;" required></textarea>
            </div>
        </div>
    </x-ModalForm>
    <x-ModalDeducibles />
@endpush

@push('scripts')
    <script>
        $(document).ready(async () => {
            await buildDataTable("registros/fletes",
                [{
                        data: "id"
                    },
                    {
                        data: "codFicha"
                    },
                    {
                        data: "manifiesto"
                    },
                    {
                        data: "placa"
                    },
                    {
                        data: "flete"
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
                        data: "observacion"
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
            await buildSelectForm("api/select/maquinarias", "idMaquinaria", "Seleccione la placa");
            await buildSelectForm("api/select/contratos", "idContrato", "Seleccione el contrato");
            $("#fechaInicio, #fechaFin").datepicker({
                orientation: "buttom left",
                todayHighlight: true,
                templates: vars.controls,
            });
        });

        const crearRegistro = async (form) => {
            await buildCreateRegister("api/registros", form);
        };

        const editarRegistro = async (id) => {
            await buildEditRegister(id, "api/registros",
                [
                    "modulo",
                    "codFicha",
                    "manifiesto",
                    "hraOpInicio",
                    "hraOpFin",
                    "horometroInicio",
                    "horometroFin",
                    "fechaInicio",
                    "fechaFin"
                ], ["idMaquinaria", "idContrato"]);
        }

        const statusRegistro = async (id) => {
            await buildStatusRegister(id, "api/registros");
        };

        const eliminarRegistro = async (id) => {
            await buildDeleteRegister(id, "api/registros");
        };

        const deducibles = async (id, ficha) => {}
    </script>
@endpush
