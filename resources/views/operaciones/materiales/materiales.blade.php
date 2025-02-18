@extends('layouts.dashboard')

@section('title', 'Materiales')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Tabla de Materiales
                    </h2>
                    <div class="panel-toolbar">
                        <button type="button" class="btn btn-info active" onclick="showModalRegistro('Material');">
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
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
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
    <x-ModalForm title="Agregar Material" description="El material a transportar es la carga que lleva el vehiculo." form>
        <div class="form-row">
            <x-InputBase col="12" name="nombre" type="text" label="Nombre Material"
                placeholder="Ingresa nombre del Material" required max="191" />
            <x-InputBase textarea col="12" name="descripcion" label="Descripción de Material"
                placeholder="Ingresa la descripción del Material" required />
        </div>
    </x-ModalForm>
@endpush

@push('scripts')
    <script>
        $(document).ready(async () => {
            await buildDataTable("materiales",
                [{
                        data: "id"
                    },
                    {
                        data: "nombre"
                    },
                    {
                        data: "descripcion"
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
            await buildCreateRegister("api/materiales", form);
        };

        const editarRegistro = async (id) => {
            await buildEditRegister(id, "api/materiales", ["nombre", "descripcion"]);
        }

        const statusRegistro = async (id) => {
            await buildStatusRegister(id, "api/materiales");
        };

        const eliminarRegistro = async (id) => {
            await buildDeleteRegister(id, "api/materiales");
        };
    </script>
@endpush
