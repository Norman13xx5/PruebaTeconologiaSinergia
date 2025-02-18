@extends('layouts.dashboard')

@section('title', 'Usuarios')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Tabla de Usuarios
                    </h2>
                    <div class="panel-toolbar">
                        <button type="button" class="btn btn-info active" onclick="showModalRegistro('Usuario', true);">
                            Agregar <i class="fal fa-plus-square"></i>
                        </button>
                    </div>
                </div>
                <x-DataTable>
                    <th>Id</th>
                    <th>Identificación</th>
                    <th>Nombres</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Telefono</th>
                    <th>Correo Electronico</th>
                    <th>Nombre Fiscal</th>
                    <th>Dirección Fiscal</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </x-DataTable>
            </div>
        </div>
    </div>
@endsection

@push('modals')
    <x-ModalForm title="Agregar Usuario"
        description="Los usuarios dependen de una empresa directatente y segun su rol pertenecen a una sucursal o no." form>
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label class="form-label" for="identificacion">Identificacion</label>
                <input type="number" onKeyPress="if(this.value.length==50)return false;" min="0"
                    class="form-control" id="identificacion" name="identificacion" placeholder="Identificación del usuario"
                    required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label" for="nombres">Nombres</label>
                <div class="input-group">
                    <input type="text" onKeyPress="if(this.value.length==50)return false;" min="0"
                        class="form-control" id="nombres" name="nombres" placeholder="Nombres del usuario" required>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="aPaterno">Apellido Paterno</label>
                <input type="text" onKeyPress="if(this.value.length==30)return false;" min="0"
                    class="form-control" id="aPaterno" name="aPaterno" placeholder="Apellido Paterno" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="aMaterno">Apellido Materno</label>
                <input type="text" onKeyPress="if(this.value.length==30)return false;" min="0"
                    class="form-control" id="aMaterno" name="aMaterno" placeholder="Apellido Materno" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="telefono">Telefono</label>
                <input type="number" onKeyPress="if(this.value.length==10)return false;" min="0"
                    class="form-control" id="telefono" name="telefono" placeholder="Telefono" required>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-8 mb-3">
                <label class="form-label" for="emailUser">Correo Electronico</label>
                <input type="email" onKeyPress="if(this.value.length==100)return false;" min="0"
                    class="form-control" id="emailUser" name="emailUser" placeholder="Correo Electronico del usuario"
                    required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="pswd">Contraseña</label>
                <input type="text" onKeyPress="if(this.value.length==20)return false;" min="0"
                    class="form-control" id="pswd" name="pswd" placeholder="Contraseña" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="nombreFiscal">Nombre Fiscal</label>
                <input type="text" onKeyPress="if(this.value.length==81)return false;" min="0"
                    class="form-control" id="nombreFiscal" name="nombreFiscal" placeholder="Nombre fiscal del usuario"
                    required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="direccionFiscal">Dirección Fiscal</label>
                <input type="text" onKeyPress="if(this.value.length==100)return false;" min="0"
                    class="form-control" id="direccionFiscal" name="direccionFiscal"
                    placeholder="Dirección fiscal del usuario" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Rol Usuario</label>
                <select class="custom-select form-control" id="rolId" name="rolId">
                </select>
            </div>
        </div>
        <x-InputBase file title="Foto de Usuario" label="Adjuntar Foto del Usuario" accept="image/png"
            span="Foto del usuario en formato png." />
    </x-ModalForm>
@endpush

@push('scripts')
    <script>
        $(document).ready(async () => {
            await buildDataTable("usuarios",
                [{
                        data: 'id',
                    },
                    {
                        data: "identificacion"
                    },
                    {
                        data: "nombres"
                    },
                    {
                        data: "aPaterno"
                    },
                    {
                        data: "aMaterno"
                    },
                    {
                        data: "telefono"
                    },
                    {
                        data: "emailUser"
                    },
                    {
                        data: "nombreFiscal"
                    },
                    {
                        data: "direccionFiscal"
                    },
                    {
                        data: "rol"
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
            await buildSelectForm("api/select/roles", "rolId", "Seleccione el Rol");
        });

        const crearRegistro = async (form) => {
            await buildCreateRegister("api/usuarios", form);
        };

        const editarRegistro = async (id) => {
            await buildEditRegister(id, "api/usuarios",
                [
                    "identificacion",
                    "nombres",
                    "aPaterno",
                    "aMaterno",
                    "telefono",
                    "emailUser",
                    "pswd",
                    "nombreFiscal",
                    "direccionFiscal",
                    "archivo",
                ], ["rolId"], true);
        }

        const statusRegistro = async (id) => {
            await buildStatusRegister(id, "api/usuarios");
        };

        const eliminarRegistro = async (id) => {
            await buildDeleteRegister(id, "api/usuarios");
        };
    </script>
@endpush
