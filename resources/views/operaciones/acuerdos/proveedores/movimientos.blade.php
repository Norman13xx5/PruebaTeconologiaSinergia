@extends('layouts.dashboard')

@section('title', 'Acuerdos Movimientos Proveedores')

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
                    <th>Ruta</th>
                    <th>Kilometraje pactado</th>
                    <th>Tarifa pactada</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </x-DataTable>
            </div>
        </div>
    </div>
@endsection

@push('modals')
    <x-ModalForm title="Agregar Acuerdo de Movimeintos"
        description="Puedes asignar a una misma placa a varios acuerdos(rutas)." form>
        <div class="form-row">
            <input type="hidden" id="modulo" name="modulo" value="movimientos">
            <input type="hidden" id="clienteProveedor" name="clienteProveedor" value="proveedor">
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
                <label class="form-label">Asignar Ruta:</label>
                <select class="custom-select form-control" id="idRuta" name="idRuta">
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label" for="kilometraje">Kilometraje Pactado:</label>
                <input type="text" onkeypress="return filterFloat(event,this);" class="form-control" id="kilometraje"
                    name="kilometraje" placeholder="Kilometraje pactado (18.5)" required>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label" for="tarifa">Tarifa Pactada:</label>
                <input type="text" onkeypress="return filterFloat(event,this);" class="form-control" id="tarifa"
                    name="tarifa" placeholder="Tarifa pactada (600.70)" required>
            </div>
        </div>
    </x-ModalForm>
@endpush

@push('scripts')
    <script>
        $(document).ready(async () => {
            await buildDataTable("acuerdos/clientes/movimientos",
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
                        data: "ruta"
                    },
                    {
                        data: "kilometraje"
                    },
                    {
                        data: "tarifa"
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
            await buildSelectForm("api/select/rutas", "idRuta", "Seleccione la ruta");
        });

        const crearRegistro = async (form) => {
            await buildCreateRegister("api/acuerdos/movimientos", form);
        };

        const editarRegistro = async (id) => {
            await buildEditRegister(id, "api/acuerdos/movimientos",
                [
                    "modulo",
                    "clienteProveedor",
                    "kilometraje",
                    "tarifa",
                ], ["idMaquinaria", "idContrato", "idRuta"]);
        }

        const statusRegistro = async (id) => {
            await buildStatusRegister(id, "api/acuerdos/movimientos");
        };

        const eliminarRegistro = async (id) => {
            await buildDeleteRegister(id, "api/acuerdos/movimientos");
        };
    </script>
@endpush
