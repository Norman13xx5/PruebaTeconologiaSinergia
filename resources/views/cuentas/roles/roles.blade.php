@extends('layouts.dashboard')

@section('title', 'Roles')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Tabla de Roles
                    </h2>
                    <div class="panel-toolbar">
                        <button type="button" class="btn btn-info active" onclick="showModalRegistro('Rol');">
                            Agregar <i class="fal fa-plus-square"></i>
                        </button>
                    </div>
                </div>
                <x-DataTable>
                    <th>Id</th>
                    <th>Nombre Rol</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </x-DataTable>
            </div>
        </div>
    </div>
@endsection

@push('modals')
    <x-ModalForm title="Agregar Rol" description="Un rol es la clasificación en la plataforma de cada usuario." form>
        <div class="form-row">
            <x-InputBase col="12" name="nombreRol" type="text" label="Nombre Rol"
                placeholder="Ingresa nombre del rol" required max="191" />
            <x-InputBase textarea col="12" name="descripcion" label="Descripción de Rol"
                placeholder="Ingresa la descripción del rol" required />
        </div>
    </x-ModalForm>
@endpush

@push('scripts')
    <script>
        $(document).ready(async () => {
            await buildDataTable("roles",
                [{
                        data: "id"
                    },
                    {
                        data: "nombreRol"
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
            await buildCreateRegister("api/roles", form);
        };

        const editarRegistro = async (id) => {
            await buildEditRegister(id, "api/roles", ["nombreRol", "descripcion"]);
        }

        const statusRegistro = async (id) => {
            await buildStatusRegister(id, "api/roles");
        };

        const eliminarRegistro = async (id) => {
            await buildDeleteRegister(id, "api/roles");
        };
    </script>
@endpush
