@extends('layouts.dashboard')

@section('title', 'Rutas')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Tabla de Rutas
                    </h2>
                    <div class="panel-toolbar">
                        <button type="button" class="btn btn-info active" onclick="showModalRegistro('Ruta', 'add', true);">
                            Agregar <i class="fal fa-plus-square"></i>
                        </button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <table id="dataTableLaravel" class="table table-bordered table-hover table-striped w-100">
                            <thead class="bg-primary-600">
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre de Ruta</th>
                                    <th>Origen</th>
                                    <th>Destino</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('modals')
    <x-ModalForm title="Agregar Rutas" description="La tarifa asignada a la ruta es la que se le cobra al contrato." form>
        <div class="form-row">
            <div class="col-md-12 mb-3">
                <label class="form-label" for="nombre">Nombre de la Ruta</label>
                <input type="text" onKeyPress="if(this.value.length==200)return false;" class="form-control"
                    id="nombre" name="nombre" placeholder="Nombre de la ruta" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label" for="origen">Origen de la Ruta</label>
                <input type="text" onKeyPress="if(this.value.length==50)return false;" class="form-control"
                    id="origen" name="origen" placeholder="Nombre de la ruta" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label" for="destino">Destino de la Ruta</label>
                <input type="text" onKeyPress="if(this.value.length==50)return false;" class="form-control"
                    id="destino" name="destino" placeholder="Nombre de la ruta" required>
            </div>
        </div>
    </x-ModalForm>
@endpush

@push('scripts')
    <script>
        $(document).ready(async () => {
            await buildDataTable("rutas",
                [{
                        data: "id"
                    },
                    {
                        data: "nombre"
                    },
                    {
                        data: "origen"
                    },
                    {
                        data: "destino"
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
        });

        const crearRegistro = async (form) => {
            await buildCreateRegister("api/rutas", form);
        };

        const editarRegistro = async (id) => {
            await buildEditRegister(id, "api/rutas", ["nombre", "origen", "destino"]);
        }

        const statusRegistro = async (id) => {
            await buildStatusRegister(id, "api/rutas");
        };

        const eliminarRegistro = async (id) => {
            await buildDeleteRegister(id, "api/rutas");
        };
    </script>
@endpush
