@extends('layouts.dashboard')

@section('title', 'Salarios')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Tabla de Salarios
                    </h2>
                    <div class="panel-toolbar">
                        <button type="button" class="btn btn-info active" onclick="showModalRegistro('Salario', true);">
                            Agregar <i class="fal fa-plus-square"></i>
                        </button>
                    </div>
                </div>
                <x-DataTable>
                    <th>ID</th>
                    <th>Descripción</th>
                    <th>Monto</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </x-DataTable>
            </div>
        </div>
    </div>
@endsection

@push('modals')
    <x-ModalForm title="Agregar Salario" description="Los salarios son deacuerdo a la nomina del usuario." form>
        <div class="form-row">
            <x-InputBase col="6" name="description" type="text" label="Descripción"
                placeholder="Ingresa descripcion de la nomina" required max="191" />
            <x-InputBase col="6" name="amount" type="number" label="Salario"
                placeholder="Ingrese cantidad del salario" required max="1000000" />
        </div>
    </x-ModalForm>
@endpush

@push('scripts')
    <script>
        $(document).ready(async () => {
            await buildDataTable("salarios",
                [{
                        data: 'id',
                    },
                    {
                        data: 'description',
                    },
                    {
                        data: 'amount',
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
        });

        const crearRegistro = async (form) => {
            await buildCreateRegister("api/salarios", form);
        };

        const editarRegistro = async (nit) => {
            await buildEditRegister(nit, "api/salarios",
                [
                    "id",
                    "description",
                    "amount",
                ], true);
        }

        const statusRegistro = async (nit) => {
            await buildStatusRegister(nit, "api/salarios");
        };

        const eliminarRegistro = async (nit) => {
            await buildDeleteRegister(nit, "api/salarios");
        };
    </script>
@endpush
