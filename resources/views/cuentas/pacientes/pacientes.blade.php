@extends('layouts.dashboard')

@section('title', 'Pacientes')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Tabla de Pacientes
                    </h2>
                    <div class="panel-toolbar">
                        <button type="button" class="btn btn-info active" onclick="showModalRegistro('Empresa', true);">
                            Agregar <i class="fal fa-plus-square"></i>
                        </button>
                    </div>
                </div>
                <x-DataTable>
                    <th>ID</th>
                    <th>Tipo Documento</th>
                    <th>Documento</th>
                    <th>Nombre</th>
                    <th>Genero</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </x-DataTable>
            </div>
        </div>
    </div>
@endsection

@push('modals')
    <x-ModalForm title="Agregar Paciente" description="Los pacientes son esenciales en esta empresa." form>
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Tipo Documento</label>
                <select class="custom-select form-control" id="tipo_documento_id" name="tipo_documento_id">
                </select>
            </div>
            <x-InputBase col="6" name="numero_documento" id="numero_documento" type="number"
                label="Número Documento" placeholder="Ingresa documento identificación" required max="20" />
            <x-InputBase col="3" name="nombre1" type="text" label="Primer Nombre"
                placeholder="Ingresa primer nombre" required max="191" />
            <x-InputBase col="3" name="nombre2" type="text" label="Segundo Nombre"
                placeholder="Ingresa segundo nombre" required max="191" />
            <x-InputBase col="3" name="apellido1" type="text" label="Primer Apellido"
                placeholder="Ingresa primer apellido" required max="191" />
            <x-InputBase col="3" name="apellido2" type="text" label="Segundo Apellido"
                placeholder="Ingresa segundo apellido" required max="191" />
            <div class="col-md-12 mb-3">
                <label class="form-label">Genero</label>
                <select class="custom-select form-control" id="genero_id" name="genero_id">
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Departamento</label>
                <select class="custom-select form-control" id="departamento_id" name="departamento_id">
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Municipio</label>
                <select class="custom-select form-control" id="municipio_id" name="municipio_id">
                </select>
            </div>
            {{-- <x-InputBase file title="Logo de la empresa" label="Adjuntar Logo" accept="image/png"
            span="Foto del logo de la empresa en formato png." /> --}}
        </div>
    </x-ModalForm>
@endpush


@push('scripts')
    <script>
        $(document).ready(async () => {
            await buildDataTable("pacientes",
                [{
                        data: 'id',
                    },
                    {
                        data: 'tipo_documento',
                    },
                    {
                        data: 'numero_documento',
                    },
                    {
                        data: 'nombre',
                    },
                    {
                        data: 'genero',
                    },
                    {
                        data: 'status',
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]);
            await buildSelectForm("api/select/typesids", "tipo_documento_id", "Seleccione Tipo Documento");
            await buildSelectForm("api/select/genres", "genero_id", "Seleccione Genero");
            await buildSelectForm("api/select/departments", "departamento_id", "Seleccione Departamento");
            await buildSelectForm("api/select/municipalities", "municipio_id", "Seleccione Municipio");
        });

        const crearRegistro = async (form) => {
            await buildCreateRegister("api/pacientes", form);
        };

        const editarRegistro = async (id) => {
            await buildEditRegister(id, "api/pacientes",
                [
                    "id",
                    "tipo_documento_id",
                    "numero_documento",
                    "nombre1",
                    "nombre2",
                    "apellido1",
                    "apellido2",
                    "genero_id",
                    "departamento_id",
                    "municipio_id",
                ], ["id", "tipo_documento_id", "numero_documento", "nombre1", "nombre2", "apellido1",
                    "apellido2", "genero_id", "departamento_id", "municipio_id"
                ], true);
        }

        const statusRegistro = async (nit) => {
            await buildStatusRegister(nit, "api/pacientes");
        };
        const eliminarRegistro = async (nit) => {
            await buildDeleteRegister(nit, "api/pacientes");
        };
    </script>
@endpush
