@extends('layouts.dashboard')

@section('title', 'Acuerdos Alquiler Proveedores')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Tabla de Acuerdos
                    </h2>
                    <div class="panel-toolbar">
                        <a class="btn btn-primary mr-1" href="{{ route('acuerdos') }}">
                            <i class="fal fa-arrow-left"></i>
                            Regresar
                        </a>
                        <button type="button" class="btn btn-info active ml-1" onclick="showModalRegistro('Acuerdo');">
                            Agregar <i class="fal fa-plus-square"></i>
                        </button>
                    </div>
                </div>
                <x-DataTable>
                    <th>Id</th>
                    <th>Tipo Maquinaria</th>
                    <th>Placa o # de Registro:</th>
                    <th>Titulo del Contrato</th>
                    <th>Stand-by</th>
                    <th>Tarifa por Hora</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </x-DataTable>
            </div>
        </div>
    </div>
@endsection

@push('modals')
    <x-ModalForm title="Agregar acuerdo de Alquiler" description="Formulario para agregar los acuerdos de alquiler." form>
        <div class="form-row">
            <input type="hidden" id="modulo" name="modulo" value="alquiler">
            <input type="hidden" id="clienteProveedor" name="clienteProveedor" value="proveedor">
            <input type="hidden" id="observacion" name="observacion" value="horas">
            <div class="col-md-6 mb-3">
                <label class="form-label">Placa o # de Registro:</label>
                <select class="custom-select form-control" id="idMaquinaria" name="idMaquinaria">
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Asignar Contrato:</label>
                <select class="custom-select form-control" id="idContrato" name="idContrato">
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label" id="labelStandBy" for="standBy">
                    Stand-By(horas minimas de trabajo por mes):
                </label>
                <input type="text" onkeypress="return filterFloat(event,this);" class="form-control" id="standBy"
                    name="standBy" placeholder="Stand By (12.5)" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label" id="labelTarifa" for="horaTarifa">Valor de tarifa por hora:</label>
                <input type="text" onkeypress="return filterFloat(event,this);" class="form-control" id="horaTarifa"
                    name="horaTarifa" placeholder="Tarifa (100000.80)" required>
            </div>
            <div class="col-md-6 mb-3">
                <div class="custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="tipoAlquiler">
                    <label class="custom-control-label" for="tipoAlquiler">
                        Alquiler por kilometraje
                    </label>
                </div>
            </div>
        </div>
    </x-ModalForm>
@endpush

@push('scripts')
    <script>
        $(document).ready(async () => {
            await buildDataTable("acuerdos/proveedores/alquiler",
                [{
                        data: "id"
                    },
                    {
                        data: "tipoMaquinaria"
                    },
                    {
                        data: "maquinaria"
                    },
                    {
                        data: "titulo"
                    },
                    {
                        data: "standBy"
                    },
                    {
                        data: "horaTarifa"
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
        });

        const crearRegistro = async (form) => {
            await buildCreateRegister("api/acuerdos/alquiler", form);
        };

        const editarRegistro = async (id) => {
            await buildEditRegister(id, "api/acuerdos/alquiler",
                [
                    "modulo",
                    "clienteProveedor",
                    "observacion",
                    "standBy",
                    "horaTarifa",
                ], ["idMaquinaria", "idContrato"]);
        }

        const statusRegistro = async (id) => {
            await buildStatusRegister(id, "api/acuerdos/alquiler");
        };

        const eliminarRegistro = async (id) => {
            await buildDeleteRegister(id, "api/acuerdos/alquiler");
        };
    </script>
@endpush
