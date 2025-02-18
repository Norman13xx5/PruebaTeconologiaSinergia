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
            <x-InputBase col="6" name="numero_documento" type="number" label="Número Documento"
                placeholder="Ingresa documento identificación" required max="20" />
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
            {{-- <x-InputBase col="6" name="nit" type="number" label="NIT" placeholder="Ingresa nit de la empresa"
                required max="20" />
            <x-InputBase col="2" name="digito" type="number" label="Digito"
                placeholder="Ingresa digito de la empresa" required max="1" />
            <x-InputBase col="4" name="nombre" type="text" label="Nombre"
                placeholder="Ingresa nombre de la empresa" required max="191" />
            <x-InputBase col="4" name="representante" type="text" label="Representante"
                placeholder="Representante Legal" required max="191" />
            <x-InputBase col="4" name="telefono" type="number" label="Numero de Telefono"
                placeholder="Numero de contacto" required max="10" />
            <x-InputBase col="4" name="direccion" type="text" label="Dirección" placeholder="Dirección" required
                max="191" />
            <x-InputBase col="6" name="correo" type="email" label="Correo Electronico"
                placeholder="Correo Electronico de la empresa" required max="191" />
            <x-InputBase col="6" name="contacto" type="number" label="Numero de Contacto"
                placeholder="Numero de contacto" required max="10" />
            <x-InputBase col="6" name="emailTec" type="email" label="Correo Electronico Tecnico"
                placeholder="Correo Electronico Tecnico" required max="191" />
            <x-InputBase col="6" name="emailLogis" type="email" label="Correo Electronico Logistica"
                placeholder="Correo Electronico Logistica" required max="191" />
            <x-InputBase file title="Logo de la empresa" label="Adjuntar Logo" accept="image/png"
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
            await buildCreateRegister("api/empresas", form);
        };

        const editarRegistro = async (nit) => {
            await buildEditRegister(nit, "api/empresas",
                [
                    "nit",
                    "digito",
                    "nombre",
                    "representante",
                    "telefono",
                    "direccion",
                    "correo",
                    "contacto",
                    "emailTec",
                    "emailLogis",
                    "archivo",
                ], true);
        }

        const statusRegistro = async (nit) => {
            await buildStatusRegister(nit, "api/empresas");
        };

        const eliminarRegistro = async (nit) => {
            await buildDeleteRegister(nit, "api/empresas");
        };
    </script>
@endpush
